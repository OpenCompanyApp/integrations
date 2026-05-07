<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List possible portfolio destinations. Authentication is required for this API endpoint..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/views/move_options.
 */
class SonarQubeViewsMoveOptions extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_move_options';
    protected const DESCRIPTION = 'List possible portfolio destinations. Authentication is required for this API endpoint.

Official SonarQube Web API endpoint: GET /api/views/move_options.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio to move',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/views/move_options';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
