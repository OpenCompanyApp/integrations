<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Start workflow execution.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflows/{workflowId}.
 */
class TemporalStartWorkflowExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_start_workflow_execution_2';
    protected const DESCRIPTION = 'Start workflow execution

Official Temporal endpoint: POST /namespaces/{namespace}/workflows/{workflowId}

StartWorkflowExecution starts a new workflow execution.

 It will create the execution with a `WORKFLOW_EXECUTION_STARTED` event in its history and
 also schedule the first workflow task. Returns `WorkflowExecutionAlreadyStarted`, if an
 instance already exists with same workflow id.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'workflow_id' => array (
  'type' => 'string',
  'description' => 'workflowId parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/workflows/{workflowId}';
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
