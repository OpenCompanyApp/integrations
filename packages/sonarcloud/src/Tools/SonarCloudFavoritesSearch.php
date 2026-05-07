<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for the authenticated user favorites. Requires authentication..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/favorites/search.
 */
class SonarCloudFavoritesSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_favorites_search';
    protected const DESCRIPTION = 'Search for the authenticated user favorites. Requires authentication.

Official SonarCloud Web API endpoint: GET /api/favorites/search.';
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
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/favorites/search';
    protected const PARAM_MAP = array (
      'p' => 'p',
      'ps' => 'ps',
    );
}
