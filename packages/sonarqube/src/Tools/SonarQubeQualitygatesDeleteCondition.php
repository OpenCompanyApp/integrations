<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a condition from a quality gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/delete_condition.
 */
class SonarQubeQualitygatesDeleteCondition extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_delete_condition';
    protected const DESCRIPTION = 'Delete a condition from a quality gate. Requires the \'Administer Quality Gates\' permission.

Official SonarQube Web API endpoint: POST /api/qualitygates/delete_condition.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'Condition UUID',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/delete_condition';
    protected const PARAM_MAP = array (
      'id' => 'id',
    );
}
