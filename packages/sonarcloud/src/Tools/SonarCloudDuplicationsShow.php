<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get duplications. Require Browse permission on file's project.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/duplications/show.
 */
class SonarCloudDuplicationsShow extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_duplications_show';
    protected const DESCRIPTION = 'Get duplications. Require Browse permission on file\'s project

Official SonarCloud Web API endpoint: GET /api/duplications/show.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'File key',
        'required' => false,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id',
        'required' => false,
      ),
      'uuid' => array (
        'type' => 'string',
        'description' => 'File ID. If provided, \'key\' must not be provided.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/duplications/show';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'key' => 'key',
      'pullRequest' => 'pull_request',
      'uuid' => 'uuid',
    );
}
