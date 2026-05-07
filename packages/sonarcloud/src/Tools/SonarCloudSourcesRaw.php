<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get source code as raw text. Require 'See Source Code' permission on file.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/sources/raw.
 */
class SonarCloudSourcesRaw extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_sources_raw';
    protected const DESCRIPTION = 'Get source code as raw text. Require \'See Source Code\' permission on file

Official SonarCloud Web API endpoint: GET /api/sources/raw.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'File key',
        'required' => true,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/sources/raw';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'key' => 'key',
      'pullRequest' => 'pull_request',
    );
}
