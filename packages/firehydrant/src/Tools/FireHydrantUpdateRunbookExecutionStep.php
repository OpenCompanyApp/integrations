<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a runbook step execution.
 *
 * Maps to the official FireHydrant endpoint put /v1/runbooks/executions/{execution_id}/steps/{step_id}.
 */
class FireHydrantUpdateRunbookExecutionStep extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_runbook_execution_step';
    protected const DESCRIPTION = 'Update a runbook step execution

Official FireHydrant endpoint: PUT /v1/runbooks/executions/{execution_id}/steps/{step_id}

Updates a runbook step execution, especially for changing the state of a step execution.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/runbooks/executions/{execution_id}/steps/{step_id}';
    protected const PATH_PARAMS = array (
  'execution_id' => 'execution_id',
  'step_id' => 'step_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
