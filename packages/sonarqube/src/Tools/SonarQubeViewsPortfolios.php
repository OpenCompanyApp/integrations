<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List portfolios that can be referenced. Authentication is required for this API endpoint..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/views/portfolios.
 */
class SonarQubeViewsPortfolios extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_portfolios';
    protected const DESCRIPTION = 'List portfolios that can be referenced. Authentication is required for this API endpoint.

Official SonarQube Web API endpoint: GET /api/views/portfolios.';
    protected const PARAMETERS = array (
      'portfolio' => array (
        'type' => 'string',
        'description' => 'Key of the would-be parent portfolio',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/views/portfolios';
    protected const PARAM_MAP = array (
      'portfolio' => 'portfolio',
    );
}
