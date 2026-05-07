<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Give Compute Engine task details such as type, status, duration and associated component. Requires one of the following permissions: - 'Administer' at global or project level; - 'Execute Analysis' at global or project level; Since 6.1, field "logs" is deprecated and its value is always false..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/ce/task.
 */
class SonarQubeCeTask extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_ce_task';
    protected const DESCRIPTION = 'Give Compute Engine task details such as type, status, duration and associated component. Requires one of the following permissions: - \'Administer\' at global or project level; - \'Execute Analysis\' at global or project level; Since 6.1, field "logs" is deprecated and its value is always false.

Official SonarQube Web API endpoint: GET /api/ce/task.';
    protected const PARAMETERS = array (
      'additional_fields' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of the optional fields to be returned in response.',
        'required' => false,
        'enum' => array (
          'stacktrace',
          'scannerContext',
          'warnings',
        ),
      ),
      'id' => array (
        'type' => 'string',
        'description' => 'Id of task',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/ce/task';
    protected const PARAM_MAP = array (
      'additionalFields' => 'additional_fields',
      'id' => 'id',
    );
}
