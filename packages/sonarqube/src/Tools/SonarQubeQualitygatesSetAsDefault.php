<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Set a quality gate as the default quality gate. Parameter 'name' must be specified. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/set_as_default.
 */
class SonarQubeQualitygatesSetAsDefault extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_set_as_default';
    protected const DESCRIPTION = 'Set a quality gate as the default quality gate. Parameter \'name\' must be specified. Requires the \'Administer Quality Gates\' permission.

Official SonarQube Web API endpoint: POST /api/qualitygates/set_as_default.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'Name of the quality gate to set as default',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/set_as_default';
    protected const PARAM_MAP = array (
      'name' => 'name',
    );
}
