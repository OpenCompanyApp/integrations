<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity build configurations.
 */
class TeamCityListBuildTypes extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_build_types';
    protected const DESCRIPTION = 'List TeamCity build configurations with optional locator and fields query parameters.';
    protected const METHOD = 'listBuildTypes';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'Build type locator filter.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
