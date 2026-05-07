<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List severity matrix conditions.
 *
 * Maps to the official FireHydrant endpoint get /v1/severity_matrix/conditions.
 */
class FireHydrantListSeverityMatrixConditions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_severity_matrix_conditions';
    protected const DESCRIPTION = 'List severity matrix conditions

Official FireHydrant endpoint: GET /v1/severity_matrix/conditions

Lists conditions';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/severity_matrix/conditions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
