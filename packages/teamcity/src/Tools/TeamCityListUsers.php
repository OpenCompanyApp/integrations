<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity users.
 */
class TeamCityListUsers extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_users';
    protected const DESCRIPTION = 'List TeamCity users with optional locator and fields.';
    protected const METHOD = 'listUsers';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'User locator.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
