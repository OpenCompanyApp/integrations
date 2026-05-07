<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete an application definition. Requires 'Administrator' permission on the application.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/applications/delete.
 */
class SonarQubeApplicationsDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_delete';
    protected const DESCRIPTION = 'Delete an application definition. Requires \'Administrator\' permission on the application

Official SonarQube Web API endpoint: POST /api/applications/delete.';
    protected const PARAMETERS = array (
      'application' => array (
        'type' => 'string',
        'description' => 'Application key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/applications/delete';
    protected const PARAM_MAP = array (
      'application' => 'application',
    );
}
