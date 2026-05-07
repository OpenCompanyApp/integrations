<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a portfolio definition. Requires 'Administrator' permission on the portfolio..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/delete.
 */
class SonarQubeViewsDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_delete';
    protected const DESCRIPTION = 'Delete a portfolio definition. Requires \'Administrator\' permission on the portfolio.

Official SonarQube Web API endpoint: POST /api/views/delete.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Portfolio key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/delete';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
