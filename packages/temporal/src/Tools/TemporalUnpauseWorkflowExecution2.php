<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Unpause workflow execution.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflows/{workflowId}/unpause.
 */
class TemporalUnpauseWorkflowExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_unpause_workflow_execution_2';
    protected const DESCRIPTION = 'Unpause workflow execution

Official Temporal endpoint: POST /namespaces/{namespace}/workflows/{workflowId}/unpause

Note: This is an experimental API and the behavior may change in a future release.
 UnpauseWorkflowExecution unpauses a previously paused workflow execution specified in the request.
 Unpausing a workflow execution results in
 - The workflow execution status changes to `RUNNING` and a new WORKFLOW_EXECUTION_UNPAUSED event is added to the history
 - Workflow tasks and activity tasks are resumed.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace of the workflow to unpause.',
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
    protected const PATH = '/namespaces/{namespace}/workflows/{workflowId}/unpause';
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
