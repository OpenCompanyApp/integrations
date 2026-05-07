<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a Quality Gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/create.
 */
class SonarQubeQualitygatesCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_create';
    protected const DESCRIPTION = 'Create a Quality Gate. Requires the \'Administer Quality Gates\' permission.

Official SonarQube Web API endpoint: POST /api/qualitygates/create.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'The name of the quality gate to create',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/create';
    protected const PARAM_MAP = array (
      'name' => 'name',
    );
}
