<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a severity matrix condition.
 *
 * Maps to the official FireHydrant endpoint delete /v1/severity_matrix/conditions/{condition_id}.
 */
class FireHydrantDeleteSeverityMatrixCondition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_severity_matrix_condition';
    protected const DESCRIPTION = 'Delete a severity matrix condition

Official FireHydrant endpoint: DELETE /v1/severity_matrix/conditions/{condition_id}

Delete a specific condition';
    protected const PARAMETERS = array (
  'condition_id' =>
  array (
    'type' => 'string',
    'description' => 'condition_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
