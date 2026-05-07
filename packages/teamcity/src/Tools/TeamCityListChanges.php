<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity VCS changes.
 */
class TeamCityListChanges extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_changes';
    protected const DESCRIPTION = 'List TeamCity VCS changes with optional locator and fields.';
    protected const METHOD = 'listChanges';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'Change locator.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
