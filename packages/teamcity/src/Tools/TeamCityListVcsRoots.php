<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity VCS roots.
 */
class TeamCityListVcsRoots extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_vcs_roots';
    protected const DESCRIPTION = 'List TeamCity VCS roots with optional locator and fields.';
    protected const METHOD = 'listVcsRoots';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'VCS root locator.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
