<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Display web service response example.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/webservices/response_example.
 */
class SonarQubeWebservicesResponseExample extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_webservices_response_example';
    protected const DESCRIPTION = 'Display web service response example

Official SonarQube Web API endpoint: GET /api/webservices/response_example.';
    protected const PARAMETERS = array (
      'action' => array (
        'type' => 'string',
        'description' => 'Action of the web service',
        'required' => true,
      ),
      'controller' => array (
        'type' => 'string',
        'description' => 'Controller of the web service',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/webservices/response_example';
    protected const PARAM_MAP = array (
      'action' => 'action',
      'controller' => 'controller',
    );
}
