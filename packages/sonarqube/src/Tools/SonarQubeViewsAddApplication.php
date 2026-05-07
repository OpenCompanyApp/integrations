<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add an existing application to a portfolio. Authentication is required for this API endpoint..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/add_application.
 */
class SonarQubeViewsAddApplication extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_add_application';
    protected const DESCRIPTION = 'Add an existing application to a portfolio. Authentication is required for this API endpoint.

Official SonarQube Web API endpoint: POST /api/views/add_application.';
    protected const PARAMETERS = array (
      'application' => array (
        'type' => 'string',
        'description' => 'Key of the application to be added',
        'required' => true,
      ),
      'portfolio' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio where the application will be added',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/add_application';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'portfolio' => 'portfolio',
    );
}
