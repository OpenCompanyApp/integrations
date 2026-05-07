<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search for the authenticated user favorites. Requires authentication..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/favorites/search.
 */
class SonarQubeFavoritesSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_favorites_search';
    protected const DESCRIPTION = 'Search for the authenticated user favorites. Requires authentication.

Official SonarQube Web API endpoint: GET /api/favorites/search.';
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
