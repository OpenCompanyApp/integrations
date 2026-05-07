<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Get one TeamCity build.
 */
class TeamCityGetBuild extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_get_build';
    protected const DESCRIPTION = 'Get a TeamCity build by locator, such as id:12345.';
    protected const METHOD = 'getBuild';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build locator, for example id:12345.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
    ];
}
