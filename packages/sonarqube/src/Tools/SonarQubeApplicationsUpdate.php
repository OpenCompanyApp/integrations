<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update an application. Requires 'Administrator' permission on the application.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/applications/update.
 */
class SonarQubeApplicationsUpdate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_update';
    protected const DESCRIPTION = 'Update an application. Requires \'Administrator\' permission on the application

Official SonarQube Web API endpoint: POST /api/applications/update.';
    protected const PARAMETERS = array (
      'application' => array (
        'type' => 'string',
        'description' => 'Application key',
        'required' => true,
      ),
      'description' => array (
        'type' => 'string',
        'description' => 'New description for the application',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'New name for the application',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/applications/update';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'description' => 'description',
      'name' => 'name',
    );
}
