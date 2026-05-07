<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Copy a Quality Gate. 'sourceName' must be provided. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/copy.
 */
class SonarQubeQualitygatesCopy extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_copy';
    protected const DESCRIPTION = 'Copy a Quality Gate. \'sourceName\' must be provided. Requires the \'Administer Quality Gates\' permission.

Official SonarQube Web API endpoint: POST /api/qualitygates/copy.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'The name of the quality gate to create',
        'required' => true,
      ),
      'source_name' => array (
        'type' => 'string',
        'description' => 'The name of the quality gate to copy',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/copy';
    protected const PARAM_MAP = array (
      'name' => 'name',
      'sourceName' => 'source_name',
    );
}
