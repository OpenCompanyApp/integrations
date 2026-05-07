<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Get TeamCity build statistics.
 */
class TeamCityGetBuildStatistics extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_get_build_statistics';
    protected const DESCRIPTION = 'Get all statistical values for a TeamCity build.';
    protected const METHOD = 'getBuildStatistics';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build locator, for example id:12345.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
    ];
}
