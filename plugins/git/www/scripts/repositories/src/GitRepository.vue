<!--
  - Copyright (c) Enalean, 2018. All Rights Reserved.
  -
  - This file is a part of Tuleap.
  -
  - Tuleap is free software; you can redistribute it and/or modify
  - it under the terms of the GNU General Public License as published by
  - the Free Software Foundation; either version 2 of the License, or
  - (at your option) any later version.
  -
  - Tuleap is distributed in the hope that it will be useful,
  - but WITHOUT ANY WARRANTY; without even the implied warranty of
  - MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  - GNU General Public License for more details.
  -
  - You should have received a copy of the GNU General Public License
  - along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
  -->

<template>
    <section class="tlp-pane git-repository-card">
        <div class="tlp-pane-container">
            <a v-bind:href="repository.html_url" class="git-repository-card-link">
                <div class="tlp-pane-header git-repository-card-header">
                    <h1 class="tlp-pane-title git-repository-card-title">{{ repository.name }}</h1>
                    <a v-if="is_admin"
                       v-bind:href="repository_admin_url"
                       class="git-repository-card-admin-link"
                    >
                        <i class="fa fa-cog" v-bind:title="administration_link_title"></i>
                    </a>
                </div>
                <section class="tlp-pane-section">
                    <p v-if="hasRepositoryDescription" class="git-repository-card-description">{{ repository.description }}</p>
                    <p v-else v-translate class="git-repository-card-description">Empty description</p>
                </section>
            </a>
        </div>
    </section>
</template>
<script>
const DEFAULT_DESCRIPTION = "-- Default description --";

import { getProjectId, getUserIsAdmin } from "./repository-list-presenter.js";

export default {
    name: "GitRepository",
    props: {
        repository: Object
    },
    computed: {
        hasRepositoryDescription() {
            return this.repository.description !== DEFAULT_DESCRIPTION;
        },
        repository_admin_url() {
            return `/plugins/git/?action=repo_management&group_id=${getProjectId()}&repo_id=${
                this.repository.id
            }`;
        },
        is_admin() {
            return getUserIsAdmin();
        },
        administration_link_title() {
            return this.$gettext("Go to repository administration");
        }
    }
};
</script>
