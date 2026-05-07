<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a new application. Requires 'Administer System' permission or 'Create Applications' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/applications/create.
 */
class SonarQubeApplicationsCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_create';
    protected const DESCRIPTION = 'Create a new application. Requires \'Administer System\' permission or \'Create Applications\' permission

Official SonarQube Web API endpoint: POST /api/applications/create.';
    protected const PARAMETERS = array (
      'description' => array (
        'type' => 'string',
        'description' => 'Application description',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Application key. A suitable key will be generated if not provided',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Application name',
        'required' => true,
      ),
      'visibility' => array (
        'type' => 'string',
        'description' => 'Whether the created application should be visible to everyone, or only specific user/groups. If no visibility is specified, the default visibility will be used.',
        'required' => false,
        'enum' => array (
          'private',
          'public',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/applications/create';
    protected const PARAM_MAP = array (
      'description' => 'description',
      'key' => 'key',
      'name' => 'name',
      'visibility' => 'visibility',
    );
}
