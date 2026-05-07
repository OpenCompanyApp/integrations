<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity user groups.
 */
class TeamCityListGroups extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_groups';
    protected const DESCRIPTION = 'List TeamCity user groups with optional locator and fields.';
    protected const METHOD = 'listGroups';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'User group locator.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
