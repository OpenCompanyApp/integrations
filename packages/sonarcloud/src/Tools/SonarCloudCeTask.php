<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Give Compute Engine task details such as type, status, duration and associated component. Requires 'Execute Analysis' permission..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/ce/task.
 */
class SonarCloudCeTask extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_ce_task';
    protected const DESCRIPTION = 'Give Compute Engine task details such as type, status, duration and associated component. Requires \'Execute Analysis\' permission.

Official SonarCloud Web API endpoint: GET /api/ce/task.';
    protected const PARAMETERS = array (
      'additional_fields' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of the optional fields to be returned in response.',
        'required' => false,
        'enum' => array (
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
