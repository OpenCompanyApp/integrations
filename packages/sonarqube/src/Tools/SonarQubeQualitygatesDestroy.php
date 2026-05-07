<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a Quality Gate. Parameter 'name' must be specified. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/destroy.
 */
class SonarQubeQualitygatesDestroy extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_destroy';
    protected const DESCRIPTION = 'Delete a Quality Gate. Parameter \'name\' must be specified. Requires the \'Administer Quality Gates\' permission.

Official SonarQube Web API endpoint: POST /api/qualitygates/destroy.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'Name of the quality gate to delete',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/destroy';
    protected const PARAM_MAP = array (
      'name' => 'name',
    );
}
