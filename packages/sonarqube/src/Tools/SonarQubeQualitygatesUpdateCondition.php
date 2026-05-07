<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a condition attached to a quality gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/update_condition.
 */
class SonarQubeQualitygatesUpdateCondition extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_update_condition';
    protected const DESCRIPTION = 'Update a condition attached to a quality gate. Requires the \'Administer Quality Gates\' permission.

Official SonarQube Web API endpoint: POST /api/qualitygates/update_condition.';
    protected const PARAMETERS = array (
      'error' => array (
        'type' => 'string',
        'description' => 'Condition error threshold',
        'required' => true,
      ),
      'id' => array (
        'type' => 'string',
        'description' => 'Condition ID',
        'required' => true,
      ),
      'metric' => array (
        'type' => 'string',
        'description' => 'Condition metric. Only metric of the following types are allowed:- INT; - MILLISEC; - RATING; - WORK_DUR; - FLOAT; - PERCENT; - LEVEL; Following metrics are forbidden:- alert_status; - security_hotspots; - new_security_hotspots;',
        'required' => true,
      ),
      'op' => array (
        'type' => 'string',
        'description' => 'Condition operator: - LT = is lower than; - GT = is greater than;',
        'required' => false,
        'enum' => array (
          'LT',
          'GT',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/update_condition';
    protected const PARAM_MAP = array (
      'error' => 'error',
      'id' => 'id',
      'metric' => 'metric',
      'op' => 'op',
    );
}
