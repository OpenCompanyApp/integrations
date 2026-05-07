<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List runs in a trace.
 *
 * Maps to the official LangSmith endpoint GET /v2/traces/{trace_id}/runs.
 */
class LangSmithGetV2TracesTraceIdRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v2_traces_trace_id_runs';
    protected const DESCRIPTION = 'List runs in a trace

Official endpoint: GET /v2/traces/{trace_id}/runs
**Alpha:** The request and response contract may change; Returns runs for a trace ID within min/max start time. Optional `filter`; repeatable `selects` to select fields to return.';
    protected const PARAMETERS = array (
  'trace_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `trace_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: filter, max_start_time, min_start_time, project_id, selects.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'max_start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `max_start_time`.',
  ),
  'min_start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `min_start_time`.',
  ),
  'project_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `project_id`.',
  ),
  'selects' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `selects`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/traces/{trace_id}/runs';
    protected const PATH_PARAMS = array (
  0 => 'trace_id',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'max_start_time',
  2 => 'min_start_time',
  3 => 'project_id',
  4 => 'selects',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
