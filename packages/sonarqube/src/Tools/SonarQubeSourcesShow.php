<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get source code. Requires See Source Code permission on file's project Each element of the result array is composed of:- Line number; - Content of the line;.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/sources/show.
 */
class SonarQubeSourcesShow extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_sources_show';
    protected const DESCRIPTION = 'Get source code. Requires See Source Code permission on file\'s project Each element of the result array is composed of:- Line number; - Content of the line;

Official SonarQube Web API endpoint: GET /api/sources/show.';
    protected const PARAMETERS = array (
      'from' => array (
        'type' => 'string',
        'description' => 'First line to return. Starts at 1',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'File key',
        'required' => true,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Last line to return (inclusive)',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/sources/show';
    protected const PARAM_MAP = array (
      'from' => 'from',
      'key' => 'key',
      'to' => 'to',
    );
}
