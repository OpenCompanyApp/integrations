<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Show the details of a portfolio, including its hierarchy and project selection mode. Authentication is required for this API endpoint..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/views/show.
 */
class SonarQubeViewsShow extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_show';
    protected const DESCRIPTION = 'Show the details of a portfolio, including its hierarchy and project selection mode. Authentication is required for this API endpoint.

Official SonarQube Web API endpoint: GET /api/views/show.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'The key of the portfolio',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/views/show';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
