<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Pause workflow execution.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflows/{workflowId}/pause.
 */
class TemporalPauseWorkflowExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_pause_workflow_execution_2';
    protected const DESCRIPTION = 'Pause workflow execution

Official Temporal endpoint: POST /namespaces/{namespace}/workflows/{workflowId}/pause

Note: This is an experimental API and the behavior may change in a future release.
 PauseWorkflowExecution pauses the workflow execution specified in the request. Pausing a workflow execution results in
 - The workflow execution status changes to `PAUSED` and a new WORKFLOW_EXECUTION_PAUSED event is added to the history
 - No new workflow tasks or activity tasks are dispatched.
   - Any workflow task currently executing on the worker will be allowed to complete.
   - Any activity task currently executing will be paused.
 - All server-side events will continue to be processed by the server.
 - Queries & Updates on a paused workflow will be rejected.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace of the workflow to pause.',
  'required' => true,
),
  'workflow_id' => array (
  'type' => 'string',
  'description' => 'ID of the workflow execution to be paused. Required.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/workflows/{workflowId}/pause';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'workflowId' => 'workflow_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
