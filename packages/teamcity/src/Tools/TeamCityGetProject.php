<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Get one TeamCity project.
 */
class TeamCityGetProject extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_get_project';
    protected const DESCRIPTION = 'Get a TeamCity project by locator, such as id:ProjectId.';
    protected const METHOD = 'getProject';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Project locator, for example id:RootProject.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
    ];
}
