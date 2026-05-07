<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Get one TeamCity build configuration.
 */
class TeamCityGetBuildType extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_get_build_type';
    protected const DESCRIPTION = 'Get a TeamCity build configuration by locator, such as id:Project_Build.';
    protected const METHOD = 'getBuildType';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build type locator.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
    ];
}
