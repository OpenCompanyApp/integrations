<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity projects.
 */
class TeamCityListProjects extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_projects';
    protected const DESCRIPTION = 'List TeamCity projects. Supports locator and fields query parameters.';
    protected const METHOD = 'listProjects';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'TeamCity project locator filter.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
