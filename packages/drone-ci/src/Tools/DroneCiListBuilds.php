<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** List Drone builds for a repository. */
class DroneCiListBuilds extends AbstractDroneCiTool { protected const NAME = 'drone_ci_list_builds'; protected const DESCRIPTION = 'List Drone builds for a repository.'; protected const METHOD = 'listBuilds'; protected const REQUIRED = ['owner', 'repo']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'query' => ['type' => 'object', 'description' => 'Pagination query parameters.']]; }
