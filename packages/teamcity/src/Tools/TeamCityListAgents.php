<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity agents.
 */
class TeamCityListAgents extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_agents';
    protected const DESCRIPTION = 'List TeamCity build agents with optional locator and fields.';
    protected const METHOD = 'listAgents';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'Agent locator.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
