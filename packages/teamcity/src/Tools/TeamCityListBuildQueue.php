<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List queued TeamCity builds.
 */
class TeamCityListBuildQueue extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_build_queue';
    protected const DESCRIPTION = 'List queued TeamCity builds with optional queue locator and fields.';
    protected const METHOD = 'listBuildQueue';
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'description' => 'Build queue locator.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
