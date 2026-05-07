<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search for components.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/components/search.
 */
class SonarQubeComponentsSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_components_search';
    protected const DESCRIPTION = 'Search for components

Official SonarQube Web API endpoint: GET /api/components/search.';
    protected const PARAMETERS = array (
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
        'description' => 'Limit search to: - component names that contain the supplied string; - component keys that are exactly the same as the supplied string; The value length of the param must be between 2 and 15 (inclusive) characters. In case longer value is provided it will be truncated.',
        'required' => false,
      ),
      'qualifiers' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of component qualifiers. Filter the results with the specified qualifiers. Possible values are:- APP - Applications; - VW - Portfolios; - SVW - Portfolios; - TRK - Projects;',
        'required' => true,
        'enum' => array (
          'APP',
          'VW',
          'SVW',
          'TRK',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/components/search';
    protected const PARAM_MAP = array (
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
      'qualifiers' => 'qualifiers',
    );
}
