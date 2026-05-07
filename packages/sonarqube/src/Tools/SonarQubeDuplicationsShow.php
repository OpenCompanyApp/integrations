<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get duplications. Require Browse permission on file's project.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/duplications/show.
 */
class SonarQubeDuplicationsShow extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_duplications_show';
    protected const DESCRIPTION = 'Get duplications. Require Browse permission on file\'s project

Official SonarQube Web API endpoint: GET /api/duplications/show.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'File key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/duplications/show';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
