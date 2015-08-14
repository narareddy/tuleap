<?php
/**
 * Copyright (c) Enalean, 2014. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
 */
require_once 'constants.php';

class proftpdPlugin extends Plugin {
    const SERVICE_SHORTNAME = 'plugin_proftpd';

    public function __construct($id) {
        parent::__construct($id);
        $this->addHook('cssfile');
        $this->addHook(Event::SERVICE_CLASSNAMES);
        $this->addHook('service_is_used');
        $this->addHook('approve_pending_project');
        $this->addHook(Event::GET_SYSTEM_EVENT_CLASS);
        $this->addHook(Event::SYSTEM_EVENT_GET_TYPES_FOR_DEFAULT_QUEUE);
        $this->addHook(Event::GET_FTP_INCOMING_DIR);
        $this->addHook(Event::SERVICE_ICON);
        $this->addHook('register_project_creation');
        $this->addHook(Event::RENAME_PROJECT);
    }

    public function getPluginInfo() {
        if (! is_a($this->pluginInfo, 'ProftpdPluginInfo')) {
            $this->pluginInfo = new ProftpdPluginInfo($this);
        }
        return $this->pluginInfo;
    }

    public function process(HTTPRequest $request) {
        $this->getRouter()->route($request);
    }

    private function getRouter() {
        return new Tuleap\ProFTPd\ProftpdRouter(
            array(
                $this->getExplorerController(),
                $this->getAdminController(),
            )
        );
    }

    private function getExplorerController() {
        return new Tuleap\ProFTPd\Explorer\ExplorerController(
            new Tuleap\ProFTPd\Directory\DirectoryParser($this->getPluginInfo()->getPropVal('proftpd_base_directory')),
            $this->getPermissionsManager(),
            new Tuleap\ProFTPd\Xferlog\Dao()
        );
    }

    private function getAdminController() {
        return new Tuleap\ProFTPd\Admin\AdminController(
            $this->getPermissionsManager(),
            $this->getProftpdSystemEventManager()
        );
    }

    private function getPermissionsManager() {
        return new Tuleap\ProFTPd\Admin\PermissionsManager(
            PermissionsManager::instance(),
            new UGroupManager()
        );
    }

    public function getServiceShortname() {
        return self::SERVICE_SHORTNAME;
    }

    public function register_project_creation($params) {
        $project_template = ProjectManager::instance()->getProject($params['template_id']);
        $project          = ProjectManager::instance()->getProject($params['group_id']);

        $this->getPermissionsManager()->duplicatePermissions(
            $project_template,
            $project,
            $params['ugroupsMapping']
        );

    }

    public function service_icon($params) {
        $params['list_of_icon_unicodes'][$this->getServiceShortname()] = '\e801';
    }

    public function service_classnames(array $params) {
        $params['classnames'][$this->getServiceShortname()] = 'Tuleap\ProFTPd\ServiceProFTPd';
    }

    public function cssfile($params) {
        if (strpos($_SERVER['REQUEST_URI'], $this->getPluginPath()) === 0 ||
            strpos($_SERVER['REQUEST_URI'], '/widgets/') === 0
        ) {
            echo '<link rel="stylesheet" type="text/css" href="'.$this->getThemePath().'/css/style.css" />'."\n";
        }
    }

    public function getHooksAndCallbacks() {
        $this->addHook('logs_daily');
        return parent::getHooksAndCallbacks();
    }

    public function logs_daily($params) {
        $dao = new Tuleap\ProFTPd\Xferlog\Dao();

        $params['logs'][] = array(
            'sql'   => $dao->getLogQuery($params['group_id'], $params['logs_cond']),
            'field' => $GLOBALS['Language']->getText('plugin_proftpd', 'log_filepath'),
            'title' => $GLOBALS['Language']->getText('plugin_proftpd', 'log_title')
        );
    }

    public function service_is_used($params) {
        if ($params['shortname'] == self::SERVICE_SHORTNAME && $params['is_used']) {
            $project = $this->getProject($params['group_id']);
            $this->createDirectory($project);
        }
    }

    public function approve_pending_project($params) {
        $project = $this->getProject($params['group_id']);
        if ($project->usesService($this->getServiceShortname())) {
            $this->createDirectory($project);
        }
    }

    private function getProject($group_id) {
        $project_manager = ProjectManager::instance();

        return $project_manager->getProject($group_id);
    }

    private function createDirectory(Project $project) {
        $this->getProftpdSystemEventManager()->queueDirectoryCreate($project->getUnixName());
        $this->getProftpdSystemEventManager()->queueACLUpdate($project->getUnixName());
    }

    public function system_event_get_types_for_default_queue($params) {
        $params['types'] = array_merge($params['types'], $this->getProftpdSystemEventManager()->getTypes());
    }

    public function rename_project ($params) {
        $project             = $params['project'];
        $base_sftp_dir       = $this->getPluginInfo()->getPropVal('proftpd_base_directory');
        $old_repository_path = $base_sftp_dir  . DIRECTORY_SEPARATOR . $project->getUnixName();
        $new_repository_path = $base_sftp_dir  . DIRECTORY_SEPARATOR . $params['new_name'];

        if (is_dir($old_repository_path)) {
            rename($old_repository_path, $new_repository_path);
        }
    }

    /**
     * This callback make SystemEvent manager knows about proftpd plugin System Events
     */
    public function get_system_event_class($params) {
        $this->getProftpdSystemEventManager()->instanciateEvents(
            $params['type'],
            $params['dependencies']
        );
    }

    private function getProftpdSystemEventManager() {
        return new \Tuleap\ProFTPd\SystemEventManager(
            SystemEventManager::instance(),
            Backend::instance(),
            $this->getPermissionsManager(),
            ProjectManager::instance(),
            $this->getPluginInfo()->getPropVal('proftpd_base_directory')
        );
    }

    /**
     * @see Event::GET_FTP_INCOMING_DIR
     */
    public function get_ftp_incoming_dir($params) {
        $project = $params['project'];

        if ($project->usesService(self::SERVICE_SHORTNAME)) {
            $base_sftp_dir     = $this->getPluginInfo()->getPropVal('proftpd_base_directory');
            $params['src_dir'] = $base_sftp_dir . '/' . $project->getUnixName();
        }
    }
}
