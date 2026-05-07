<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add an existing portfolio to the structure of another portfolio. Authentication is required for this API endpoint..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/add_portfolio.
 */
class SonarQubeViewsAddPortfolio extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_add_portfolio';
    protected const DESCRIPTION = 'Add an existing portfolio to the structure of another portfolio. Authentication is required for this API endpoint.

Official SonarQube Web API endpoint: POST /api/views/add_portfolio.';
    protected const PARAMETERS = array (
      'portfolio' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio where a reference will be added',
        'required' => true,
      ),
      'reference' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio to be added',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/add_portfolio';
    protected const PARAM_MAP = array (
      'portfolio' => 'portfolio',
      'reference' => 'reference',
    );
}
