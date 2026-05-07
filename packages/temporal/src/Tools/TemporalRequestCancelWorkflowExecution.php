<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Request cancel workflow execution.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/cancel.
 */
class TemporalRequestCancelWorkflowExecution extends AbstractTemporalTool
{
    protected const NAME = 'temporal_request_cancel_workflow_execution';
    protected const DESCRIPTION = 'Request cancel workflow execution

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/cancel

RequestCancelWorkflowExecution is called by workers when they want to request cancellation of
 a workflow execution.

 This results in a new `WORKFLOW_EXECUTION_CANCEL_REQUESTED` event being written to the
 workflow history and a new workflow task created for the workflow. It returns success if the requested
 workflow is already closed. It fails with \'NotFound\' if the requested workflow doesn\'t exist.';
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
    protected const PATH = '/api/v1/namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/cancel';
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
