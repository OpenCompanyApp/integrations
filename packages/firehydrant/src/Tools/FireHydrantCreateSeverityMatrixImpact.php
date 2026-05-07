<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a severity matrix impact.
 *
 * Maps to the official FireHydrant endpoint post /v1/severity_matrix/impacts.
 */
class FireHydrantCreateSeverityMatrixImpact extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_severity_matrix_impact';
    protected const DESCRIPTION = 'Create a severity matrix impact

Official FireHydrant endpoint: POST /v1/severity_matrix/impacts

Create a new impact';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/severity_matrix/impacts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
