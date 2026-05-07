<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove a project from an application Requires 'Administrator' permission on the application.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/applications/remove_project.
 */
class SonarQubeApplicationsRemoveProject extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_remove_project';
    protected const DESCRIPTION = 'Remove a project from an application Requires \'Administrator\' permission on the application

Official SonarQube Web API endpoint: POST /api/applications/remove_project.';
    protected const PARAMETERS = array (
      'application' => array (
        'type' => 'string',
        'description' => 'Key of the application',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Key of the project',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/applications/remove_project';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'project' => 'project',
    );
}
