<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a portfolio. Requires 'Administrator' permission on the portfolio..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/update.
 */
class SonarQubeViewsUpdate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_update';
    protected const DESCRIPTION = 'Update a portfolio. Requires \'Administrator\' permission on the portfolio.

Official SonarQube Web API endpoint: POST /api/views/update.';
    protected const PARAMETERS = array (
      'description' => array (
        'type' => 'string',
        'description' => 'New description for the portfolio',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio to update',
        'required' => true,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'New name for the portfolio',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/update';
    protected const PARAM_MAP = array (
      'description' => 'description',
      'key' => 'key',
      'name' => 'name',
    );
}
