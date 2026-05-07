<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** List repositories registered to the authenticated Drone user. */
class DroneCiListCurrentUserRepos extends AbstractDroneCiTool { protected const NAME = 'drone_ci_list_current_user_repos'; protected const DESCRIPTION = 'List repositories registered to the authenticated Drone user.'; protected const METHOD = 'listCurrentUserRepos'; protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Pagination query parameters.']]; }
