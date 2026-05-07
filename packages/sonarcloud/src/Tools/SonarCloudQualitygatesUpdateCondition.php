<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Update a condition attached to a quality gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/update_condition.
 */
class SonarCloudQualitygatesUpdateCondition extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_update_condition';
    protected const DESCRIPTION = 'Update a condition attached to a quality gate. Requires the \'Administer Quality Gates\' permission.

Official SonarCloud Web API endpoint: POST /api/qualitygates/update_condition.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
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
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/update_condition';
    protected const PARAM_MAP = array (
      'error' => 'error',
      'id' => 'id',
      'metric' => 'metric',
      'op' => 'op',
      'organization' => 'organization',
    );
}
