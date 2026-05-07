<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Create a TeamCity project.
 */
class TeamCityCreateProject extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_create_project';
    protected const DESCRIPTION = 'Create a TeamCity project. Provide the official Project entity in payload.';
    protected const METHOD = 'createProject';
    protected const REQUIRED = ['payload'];
    protected const PARAMETERS = [
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'TeamCity Project entity payload.'],
    ];
}
