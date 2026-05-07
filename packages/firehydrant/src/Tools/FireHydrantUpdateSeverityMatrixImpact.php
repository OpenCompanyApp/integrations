<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a severity matrix impact.
 *
 * Maps to the official FireHydrant endpoint patch /v1/severity_matrix/impacts/{impact_id}.
 */
class FireHydrantUpdateSeverityMatrixImpact extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_severity_matrix_impact';
    protected const DESCRIPTION = 'Update a severity matrix impact

Official FireHydrant endpoint: PATCH /v1/severity_matrix/impacts/{impact_id}

Update a severity matrix impact';
    protected const PARAMETERS = array (
  'impact_id' =>
  array (
    'type' => 'string',
    'description' => 'impact_id parameter.',
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
    protected const PATH = '/v1/severity_matrix/impacts/{impact_id}';
    protected const PATH_PARAMS = array (
  'impact_id' => 'impact_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
