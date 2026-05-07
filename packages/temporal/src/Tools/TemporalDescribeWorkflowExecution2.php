<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe workflow execution.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/workflows/{execution.workflow_id}.
 */
class TemporalDescribeWorkflowExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_workflow_execution_2';
    protected const DESCRIPTION = 'Describe workflow execution

Official Temporal endpoint: GET /namespaces/{namespace}/workflows/{execution.workflow_id}

DescribeWorkflowExecution returns information about the specified workflow execution.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'execution_workflow_id' => array (
  'type' => 'string',
  'description' => 'execution.workflowId parameter.',
),
  'execution_run_id' => array (
  'type' => 'string',
  'description' => 'execution.runId parameter.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/workflows/{execution.workflow_id}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'execution.workflow_id' => 'execution_workflow_id',
);
    protected const QUERY_PARAMS = array (
  'execution.workflowId' => 'execution_workflow_id',
  'execution.runId' => 'execution_run_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
