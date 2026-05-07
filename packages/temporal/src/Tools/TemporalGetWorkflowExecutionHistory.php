<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get workflow execution history.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/workflows/{execution.workflow_id}/history.
 */
class TemporalGetWorkflowExecutionHistory extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_workflow_execution_history';
    protected const DESCRIPTION = 'Get workflow execution history

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/workflows/{execution.workflow_id}/history

GetWorkflowExecutionHistory returns the history of specified workflow execution. Fails with
 `NotFound` if the specified workflow execution is unknown to the service.';
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
  'description' => 'If a `GetWorkflowExecutionHistoryResponse` or a `PollWorkflowTaskQueueResponse` had one of
 these, it should be passed here to fetch the next page.',
),
  'wait_new_event' => array (
  'type' => 'boolean',
  'description' => 'If set to true, the RPC call will not resolve until there is a new event which matches
 the `history_event_filter_type`, or a timeout is hit.',
),
  'history_event_filter_type' => array (
  'type' => 'string',
  'description' => 'Filter returned events such that they match the specified filter type.
 Default: HISTORY_EVENT_FILTER_TYPE_ALL_EVENT.',
  'enum' => array (
  'HISTORY_EVENT_FILTER_TYPE_UNSPECIFIED',
  'HISTORY_EVENT_FILTER_TYPE_ALL_EVENT',
  'HISTORY_EVENT_FILTER_TYPE_CLOSE_EVENT',
),
),
  'skip_archival' => array (
  'type' => 'boolean',
  'description' => 'skipArchival parameter.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/workflows/{execution.workflow_id}/history';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'execution.workflow_id' => 'execution_workflow_id',
);
    protected const QUERY_PARAMS = array (
  'execution.workflowId' => 'execution_workflow_id',
  'execution.runId' => 'execution_run_id',
  'maximumPageSize' => 'maximum_page_size',
  'nextPageToken' => 'next_page_token',
  'waitNewEvent' => 'wait_new_event',
  'historyEventFilterType' => 'history_event_filter_type',
  'skipArchival' => 'skip_archival',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
