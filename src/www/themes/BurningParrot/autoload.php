<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
function autoload6eb3eaaf68ace9716bae2ea1c993c633($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = array(
            'tuleap\\theme\\burningparrot\\burningparrottheme' => '/BurningParrotTheme.php',
            'tuleap\\theme\\burningparrot\\footerpresenter' => '/FooterPresenter.php',
            'tuleap\\theme\\burningparrot\\headerpresenter' => '/HeaderPresenter.php',
            'tuleap\\theme\\burningparrot\\headerpresenterbuilder' => '/HeaderPresenterBuilder.php',
            'tuleap\\theme\\burningparrot\\javascriptpresenter' => '/JavascriptPresenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\dropdown\\dropdownpresenter' => '/Navbar/Dropdown/DropdownPresenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\dropdown\\dropdownprojectspresenter' => '/Navbar/Dropdown/DropdownProjectsPresenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\dropdown\\dropdownprojectspresenterbuilder' => '/Navbar/Dropdown/DropdownProjectsPresenterBuilder.php',
            'tuleap\\theme\\burningparrot\\navbar\\globallogoutmenuitempresenter' => '/Navbar/GlobalLogoutMenuItemPresenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\globalmenuitempresenter' => '/Navbar/GlobalMenuItemPresenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\globalnavbardropdownmenuitempresenter' => '/Navbar/GlobalNavbarDropdownMenuItemPresenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\globalnavpresenter' => '/Navbar/GlobalNavPresenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\presenter' => '/Navbar/Presenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\presenterbuilder' => '/Navbar/PresenterBuilder.php',
            'tuleap\\theme\\burningparrot\\navbar\\project\\projectpresenter' => '/Navbar/Project/ProjectPresenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\project\\projectpresenterbuilder' => '/Navbar/Project/ProjectPresenterBuilder.php',
            'tuleap\\theme\\burningparrot\\navbar\\searchpresenter' => '/Navbar/SearchPresenter.php',
            'tuleap\\theme\\burningparrot\\navbar\\usernavpresenter' => '/Navbar/UserNavPresenter.php'
        );
    }
    $cn = strtolower($class);
    if (isset($classes[$cn])) {
        require dirname(__FILE__) . $classes[$cn];
    }
}
spl_autoload_register('autoload6eb3eaaf68ace9716bae2ea1c993c633');
// @codeCoverageIgnoreEnd
