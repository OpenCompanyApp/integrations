<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Delete a TeamCity project.
 */
class TeamCityDeleteProject extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_delete_project';
    protected const DESCRIPTION = 'Delete a TeamCity project by locator.';
    protected const METHOD = 'deleteProject';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Project locator, for example id:ProjectId.'],
    ];
}
