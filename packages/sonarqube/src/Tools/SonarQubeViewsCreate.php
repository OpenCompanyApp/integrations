<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a new portfolio. Requires 'Administer System' permission or 'Create Portfolios' permission,.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/create.
 */
class SonarQubeViewsCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_create';
    protected const DESCRIPTION = 'Create a new portfolio. Requires \'Administer System\' permission or \'Create Portfolios\' permission,

Official SonarQube Web API endpoint: POST /api/views/create.';
    protected const PARAMETERS = array (
      'description' => array (
        'type' => 'string',
        'description' => 'Description for the new portfolio, can be left blank',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Key for the new portfolio. A suitable key will be generated if not provided',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Name for the new portfolio',
        'required' => true,
      ),
      'parent' => array (
        'type' => 'string',
        'description' => 'Key of the parent portfolio, when creating a sub portfolio',
        'required' => false,
      ),
      'visibility' => array (
        'type' => 'string',
        'description' => 'Whether the created portfolio or application should be visible to everyone, or only specific user/groups. Only applies to root portfolios. If no visibility is specified, the default visibility will be used.',
        'required' => false,
        'enum' => array (
          'private',
          'public',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/create';
    protected const PARAM_MAP = array (
      'description' => 'description',
      'key' => 'key',
      'name' => 'name',
      'parent' => 'parent',
      'visibility' => 'visibility',
    );
}
