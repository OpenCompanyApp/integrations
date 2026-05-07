<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a severity matrix impact.
 *
 * Maps to the official FireHydrant endpoint delete /v1/severity_matrix/impacts/{impact_id}.
 */
class FireHydrantDeleteSeverityMatrixImpact extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_severity_matrix_impact';
    protected const DESCRIPTION = 'Delete a severity matrix impact

Official FireHydrant endpoint: DELETE /v1/severity_matrix/impacts/{impact_id}

Delete a specific impact';
    protected const PARAMETERS = array (
  'impact_id' =>
  array (
    'type' => 'string',
    'description' => 'impact_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/severity_matrix/impacts/{impact_id}';
    protected const PATH_PARAMS = array (
  'impact_id' => 'impact_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
