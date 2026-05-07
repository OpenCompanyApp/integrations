<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List web services.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/webservices/list.
 */
class SonarQubeWebservicesList extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_webservices_list';
    protected const DESCRIPTION = 'List web services

Official SonarQube Web API endpoint: GET /api/webservices/list.';
    protected const PARAMETERS = array (
      'include_internals' => array (
        'type' => 'string',
        'description' => 'Include web services that are implemented for internal use only. Their forward-compatibility is not assured',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/webservices/list';
    protected const PARAM_MAP = array (
      'include_internals' => 'include_internals',
    );
}
