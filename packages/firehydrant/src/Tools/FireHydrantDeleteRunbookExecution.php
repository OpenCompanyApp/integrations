<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Terminate a runbook execution.
 *
 * Maps to the official FireHydrant endpoint delete /v1/runbooks/executions/{execution_id}.
 */
class FireHydrantDeleteRunbookExecution extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_runbook_execution';
    protected const DESCRIPTION = 'Terminate a runbook execution

Official FireHydrant endpoint: DELETE /v1/runbooks/executions/{execution_id}

Terminates a runbook execution, preventing any further steps from being executed';
    protected const PARAMETERS = array (
  'execution_id' =>
  array (
    'type' => 'string',
    'description' => 'execution_id parameter.',
    'required' => true,
  ),
  'reason' =>
  array (
    'type' => 'string',
    'description' => 'The reason for terminating the runbook execution',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/runbooks/executions/{execution_id}';
    protected const PATH_PARAMS = array (
  'execution_id' => 'execution_id',
);
    protected const QUERY_PARAMS = array (
  'reason' => 'reason',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
