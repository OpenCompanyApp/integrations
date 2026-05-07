<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a new condition to a quality gate. Parameter 'gateName' must be provided. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/create_condition.
 */
class SonarQubeQualitygatesCreateCondition extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_create_condition';
    protected const DESCRIPTION = 'Add a new condition to a quality gate. Parameter \'gateName\' must be provided. Requires the \'Administer Quality Gates\' permission.

Official SonarQube Web API endpoint: POST /api/qualitygates/create_condition.';
    protected const PARAMETERS = array (
      'error' => array (
        'type' => 'string',
        'description' => 'Condition error threshold',
        'required' => true,
      ),
      'gate_name' => array (
        'type' => 'string',
        'description' => 'Name of the quality gate',
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
    protected const PATH = '/api/qualitygates/create_condition';
    protected const PARAM_MAP = array (
      'error' => 'error',
      'gateName' => 'gate_name',
      'metric' => 'metric',
      'op' => 'op',
    );
}
