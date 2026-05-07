<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Delete TeamCity build metadata.
 */
class TeamCityDeleteBuild extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_delete_build';
    protected const DESCRIPTION = 'Delete TeamCity build metadata by locator.';
    protected const METHOD = 'deleteBuild';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build locator, for example id:12345.'],
    ];
}
