<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Reset workflow execution.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/reset.
 */
class TemporalResetWorkflowExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_reset_workflow_execution_2';
    protected const DESCRIPTION = 'Reset workflow execution

Official Temporal endpoint: POST /namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/reset

ResetWorkflowExecution will reset an existing workflow execution to a specified
 `WORKFLOW_TASK_COMPLETED` event (exclusive). It will immediately terminate the current
 execution instance. "Exclusive" means the identified completed event itself is not replayed
 in the reset history; the preceding `WORKFLOW_TASK_STARTED` event remains and will be marked as failed
 immediately, and a new workflow task will be scheduled to retry it.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'workflow_execution_workflow_id' => array (
  'type' => 'string',
  'description' => 'workflow_execution.workflow_id parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/reset';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'workflow_execution.workflow_id' => 'workflow_execution_workflow_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
