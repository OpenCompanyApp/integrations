<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List permission templates. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/permissions/search_templates.
 */
class SonarQubePermissionsSearchTemplates extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_search_templates';
    protected const DESCRIPTION = 'List permission templates. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: GET /api/permissions/search_templates.';
    protected const PARAMETERS = array (
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than or equal to 0 and less or equal than 500. If this and p param are not provided, pagination is disabled and all results are returned. If pageSize=0, no results are returned but the response will contain the total count of matching templates.',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to permission template names that contain the supplied string.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/permissions/search_templates';
    protected const PARAM_MAP = array (
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
    );
}
