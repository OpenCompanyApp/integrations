<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get system logs in plain-text format. Requires system administration permission..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/system/logs.
 */
class SonarQubeSystemLogs extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_logs';
    protected const DESCRIPTION = 'Get system logs in plain-text format. Requires system administration permission.

Official SonarQube Web API endpoint: GET /api/system/logs.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'Name of the logs to get',
        'required' => false,
        'enum' => array (
          'access',
          'app',
          'ce',
          'deprecation',
          'es',
          'web',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/system/logs';
    protected const PARAM_MAP = array (
      'name' => 'name',
    );
}
