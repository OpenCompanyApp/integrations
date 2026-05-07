<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a project to an application. Requires 'Administrator' permission on the application.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/applications/add_project.
 */
class SonarQubeApplicationsAddProject extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_add_project';
    protected const DESCRIPTION = 'Add a project to an application. Requires \'Administrator\' permission on the application

Official SonarQube Web API endpoint: POST /api/applications/add_project.';
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
    protected const PATH = '/api/applications/add_project';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'project' => 'project',
    );
}
