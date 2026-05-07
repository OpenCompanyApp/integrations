<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a severity matrix condition.
 *
 * Maps to the official FireHydrant endpoint get /v1/severity_matrix/conditions/{condition_id}.
 */
class FireHydrantGetSeverityMatrixCondition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_severity_matrix_condition';
    protected const DESCRIPTION = 'Get a severity matrix condition

Official FireHydrant endpoint: GET /v1/severity_matrix/conditions/{condition_id}

Retrieve a specific condition';
    protected const PARAMETERS = array (
  'condition_id' =>
  array (
    'type' => 'string',
    'description' => 'condition_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/severity_matrix/conditions/{condition_id}';
    protected const PATH_PARAMS = array (
  'condition_id' => 'condition_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
