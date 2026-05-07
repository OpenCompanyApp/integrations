<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a runbook execution.
 *
 * Maps to the official FireHydrant endpoint get /v1/runbooks/executions/{execution_id}.
 */
class FireHydrantGetRunbookExecution extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_runbook_execution';
    protected const DESCRIPTION = 'Get a runbook execution

Official FireHydrant endpoint: GET /v1/runbooks/executions/{execution_id}

Retrieve a runbook execution by ID';
    protected const PARAMETERS = array (
  'execution_id' =>
  array (
    'type' => 'string',
    'description' => 'execution_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/runbooks/executions/{execution_id}';
    protected const PATH_PARAMS = array (
  'execution_id' => 'execution_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
