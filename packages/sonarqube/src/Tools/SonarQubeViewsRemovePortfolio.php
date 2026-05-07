<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove a reference to a portfolio. Requires 'Administrator' permission on the portfolio..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/remove_portfolio.
 */
class SonarQubeViewsRemovePortfolio extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_remove_portfolio';
    protected const DESCRIPTION = 'Remove a reference to a portfolio. Requires \'Administrator\' permission on the portfolio.

Official SonarQube Web API endpoint: POST /api/views/remove_portfolio.';
    protected const PARAMETERS = array (
      'portfolio' => array (
        'type' => 'string',
        'description' => 'Portfolio key',
        'required' => true,
      ),
      'reference' => array (
        'type' => 'string',
        'description' => 'Key of the referenced portfolio to be removed',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/remove_portfolio';
    protected const PARAM_MAP = array (
      'portfolio' => 'portfolio',
      'reference' => 'reference',
    );
}
