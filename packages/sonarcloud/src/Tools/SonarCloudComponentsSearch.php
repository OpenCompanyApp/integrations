<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for projects. Used to provide the ability to search for any component but this option has been removed and webservice 'api/components/tree' should be used instead for this purpose.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/components/search.
 */
class SonarCloudComponentsSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_components_search';
    protected const DESCRIPTION = 'Search for projects. Used to provide the ability to search for any component but this option has been removed and webservice \'api/components/tree\' should be used instead for this purpose

Official SonarCloud Web API endpoint: GET /api/components/search.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => true,
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to: - component names that contain the supplied string; - component keys that are exactly the same as the supplied string;',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/components/search';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
    );
}
