<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get the list of all the plugins installed on the SonarQube instance, sorted by plugin name. Requires authentication..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/plugins/installed.
 */
class SonarQubePluginsInstalled extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_plugins_installed';
    protected const DESCRIPTION = 'Get the list of all the plugins installed on the SonarQube instance, sorted by plugin name. Requires authentication.

Official SonarQube Web API endpoint: GET /api/plugins/installed.';
    protected const PARAMETERS = array (
      'f' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of the additional fields to be returned in response. No additional field is returned by default. Possible values are:- category - category as defined in the Update Center. A connection to the Update Center is needed;',
        'required' => false,
        'enum' => array (
          'category',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/plugins/installed';
    protected const PARAM_MAP = array (
      'f' => 'f',
    );
}
