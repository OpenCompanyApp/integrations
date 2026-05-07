<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get source code as raw text. Require 'See Source Code' permission on file.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/sources/raw.
 */
class SonarQubeSourcesRaw extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_sources_raw';
    protected const DESCRIPTION = 'Get source code as raw text. Require \'See Source Code\' permission on file

Official SonarQube Web API endpoint: GET /api/sources/raw.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'File key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/sources/raw';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
