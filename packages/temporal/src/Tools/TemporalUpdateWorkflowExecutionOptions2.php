<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Update workflow execution options.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/update-options.
 */
class TemporalUpdateWorkflowExecutionOptions2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_update_workflow_execution_options_2';
    protected const DESCRIPTION = 'Update workflow execution options

Official Temporal endpoint: POST /namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/update-options

UpdateWorkflowExecutionOptions partially updates the WorkflowExecutionOptions of an existing workflow execution.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'The namespace name of the target Workflow.',
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
    protected const PATH = '/namespaces/{namespace}/workflows/{workflow_execution.workflow_id}/update-options';
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
