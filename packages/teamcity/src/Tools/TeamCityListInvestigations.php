<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity investigations.
 */
class TeamCityListInvestigations extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_investigations';
    protected const DESCRIPTION = 'List TeamCity investigations with optional locator and fields.';
    protected const METHOD = 'listInvestigations';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'Investigation locator.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
