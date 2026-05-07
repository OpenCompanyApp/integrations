<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity builds.
 */
class TeamCityListBuilds extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_builds';
    protected const DESCRIPTION = 'List TeamCity builds using the official build locator and fields query parameters.';
    protected const METHOD = 'listBuilds';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'Build locator, for example buildType:id:Project_Build,status:SUCCESS.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
