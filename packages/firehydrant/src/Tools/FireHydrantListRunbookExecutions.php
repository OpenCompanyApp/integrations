<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List runbook executions.
 *
 * Maps to the official FireHydrant endpoint get /v1/runbooks/executions.
 */
class FireHydrantListRunbookExecutions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_runbook_executions';
    protected const DESCRIPTION = 'List runbook executions

Official FireHydrant endpoint: GET /v1/runbooks/executions

List all runbook executions across all runbooks';
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
    protected const PATH = '/v1/runbooks/executions';
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
