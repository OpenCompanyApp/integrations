<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get workflow execution history reverse.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/workflows/{execution.workflow_id}/history-reverse.
 */
class TemporalGetWorkflowExecutionHistoryReverse extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_workflow_execution_history_reverse';
    protected const DESCRIPTION = 'Get workflow execution history reverse

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/workflows/{execution.workflow_id}/history-reverse

GetWorkflowExecutionHistoryReverse returns the history of specified workflow execution in reverse
 order (starting from last event). Fails with`NotFound` if the specified workflow execution is
 unknown to the service.';
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
  'maximum_page_size' => array (
  'type' => 'integer',
  'description' => 'maximumPageSize parameter.',
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'nextPageToken parameter.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/workflows/{execution.workflow_id}/history-reverse';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'execution.workflow_id' => 'execution_workflow_id',
);
    protected const QUERY_PARAMS = array (
  'execution.workflowId' => 'execution_workflow_id',
  'execution.runId' => 'execution_run_id',
  'maximumPageSize' => 'maximum_page_size',
  'nextPageToken' => 'next_page_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
