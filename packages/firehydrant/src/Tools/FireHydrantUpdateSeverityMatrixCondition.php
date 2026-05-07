<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a severity matrix condition.
 *
 * Maps to the official FireHydrant endpoint patch /v1/severity_matrix/conditions/{condition_id}.
 */
class FireHydrantUpdateSeverityMatrixCondition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_severity_matrix_condition';
    protected const DESCRIPTION = 'Update a severity matrix condition

Official FireHydrant endpoint: PATCH /v1/severity_matrix/conditions/{condition_id}

Update a severity matrix condition';
    protected const PARAMETERS = array (
  'condition_id' =>
  array (
    'type' => 'string',
    'description' => 'condition_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/severity_matrix/conditions/{condition_id}';
    protected const PATH_PARAMS = array (
  'condition_id' => 'condition_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
