<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity problems.
 */
class TeamCityListProblems extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_problems';
    protected const DESCRIPTION = 'List TeamCity build problems with optional locator and fields.';
    protected const METHOD = 'listProblems';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'Problem locator.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
