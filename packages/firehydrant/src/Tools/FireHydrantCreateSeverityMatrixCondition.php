<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a severity matrix condition.
 *
 * Maps to the official FireHydrant endpoint post /v1/severity_matrix/conditions.
 */
class FireHydrantCreateSeverityMatrixCondition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_severity_matrix_condition';
    protected const DESCRIPTION = 'Create a severity matrix condition

Official FireHydrant endpoint: POST /v1/severity_matrix/conditions

Create a new condition';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/severity_matrix/conditions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
