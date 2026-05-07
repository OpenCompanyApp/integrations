<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Move a portfolio. Authentication is required for this API endpoint..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/move.
 */
class SonarQubeViewsMove extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_move';
    protected const DESCRIPTION = 'Move a portfolio. Authentication is required for this API endpoint.

Official SonarQube Web API endpoint: POST /api/views/move.';
    protected const PARAMETERS = array (
      'destination' => array (
        'type' => 'string',
        'description' => 'Key of the destination portfolio',
        'required' => true,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio to move',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/move';
    protected const PARAM_MAP = array (
      'destination' => 'destination',
      'key' => 'key',
    );
}
