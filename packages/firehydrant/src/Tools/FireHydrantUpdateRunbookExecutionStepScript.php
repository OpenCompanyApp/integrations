<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a script step's execution status.
 *
 * Maps to the official FireHydrant endpoint put /v1/runbooks/executions/{execution_id}/steps/{step_id}/script/{state}.
 */
class FireHydrantUpdateRunbookExecutionStepScript extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_runbook_execution_step_script';
    protected const DESCRIPTION = 'Update a script step\'s execution status

Official FireHydrant endpoint: PUT /v1/runbooks/executions/{execution_id}/steps/{step_id}/script/{state}

Updates the execution\'s step.';
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
  'state' =>
  array (
    'type' => 'string',
    'description' => 'state parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/runbooks/executions/{execution_id}/steps/{step_id}/script/{state}';
    protected const PATH_PARAMS = array (
  'execution_id' => 'execution_id',
  'step_id' => 'step_id',
  'state' => 'state',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
