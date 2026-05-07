<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Add a new condition to a quality gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/create_condition.
 */
class SonarCloudQualitygatesCreateCondition extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_create_condition';
    protected const DESCRIPTION = 'Add a new condition to a quality gate. Requires the \'Administer Quality Gates\' permission.

Official SonarCloud Web API endpoint: POST /api/qualitygates/create_condition.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'error' => array (
        'type' => 'string',
        'description' => 'Condition error threshold',
        'required' => true,
      ),
      'gate_id' => array (
        'type' => 'string',
        'description' => 'ID of the quality gate',
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
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/create_condition';
    protected const PARAM_MAP = array (
      'error' => 'error',
      'gateId' => 'gate_id',
      'metric' => 'metric',
      'op' => 'op',
      'organization' => 'organization',
    );
}
