<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a step's bash script.
 *
 * Maps to the official FireHydrant endpoint get /v1/runbooks/executions/{execution_id}/steps/{step_id}/script.
 */
class FireHydrantGetRunbookExecutionStepScript extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_runbook_execution_step_script';
    protected const DESCRIPTION = 'Get a step\'s bash script

Official FireHydrant endpoint: GET /v1/runbooks/executions/{execution_id}/steps/{step_id}/script

Retrieves the bash script from a "script" step.';
    protected const PARAMETERS = array (
  'execution_id' =>
  array (
    'type' => 'string',
    'description' => 'execution_id parameter.',
    'required' => true,
  ),
  'step_id' =>
  array (
    'type' => 'string',
    'description' => 'step_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/runbooks/executions/{execution_id}/steps/{step_id}/script';
    protected const PATH_PARAMS = array (
  'execution_id' => 'execution_id',
  'step_id' => 'step_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
