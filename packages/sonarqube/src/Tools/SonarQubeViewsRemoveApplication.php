<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove an application from a portfolio. Requires 'Administrator' permission on the portfolio..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/remove_application.
 */
class SonarQubeViewsRemoveApplication extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_remove_application';
    protected const DESCRIPTION = 'Remove an application from a portfolio. Requires \'Administrator\' permission on the portfolio.

Official SonarQube Web API endpoint: POST /api/views/remove_application.';
    protected const PARAMETERS = array (
      'application' => array (
        'type' => 'string',
        'description' => 'Key of the application to be removed',
        'required' => true,
      ),
      'portfolio' => array (
        'type' => 'string',
        'description' => 'Portfolio key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/remove_application';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'portfolio' => 'portfolio',
    );
}
