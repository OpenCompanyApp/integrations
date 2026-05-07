<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Rename a Quality Gate. 'currentName' must be specified. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/rename.
 */
class SonarQubeQualitygatesRename extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_rename';
    protected const DESCRIPTION = 'Rename a Quality Gate. \'currentName\' must be specified. Requires the \'Administer Quality Gates\' permission.

Official SonarQube Web API endpoint: POST /api/qualitygates/rename.';
    protected const PARAMETERS = array (
      'current_name' => array (
        'type' => 'string',
        'description' => 'Current name of the quality gate',
        'required' => true,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'New name of the quality gate',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/rename';
    protected const PARAM_MAP = array (
      'currentName' => 'current_name',
      'name' => 'name',
    );
}
