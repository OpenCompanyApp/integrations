<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Terminate workflow execution.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/terminate.
 */
class TemporalTerminateWorkflowExecution extends AbstractTemporalTool
{
    protected const NAME = 'temporal_terminate_workflow_execution';
    protected const DESCRIPTION = 'Terminate workflow execution

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/terminate

TerminateWorkflowExecution terminates an existing workflow execution by recording a
 `WORKFLOW_EXECUTION_TERMINATED` event in the history and immediately terminating the
 execution instance.';
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
    protected const PATH = '/api/v1/namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/terminate';
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
