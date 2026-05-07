<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Query Thread Traces.
 *
 * Maps to the official LangSmith endpoint GET /v2/threads/{thread_id}/traces.
 */
class LangSmithGetV2ThreadsThreadIdTraces extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v2_threads_thread_id_traces';
    protected const DESCRIPTION = 'Query Thread Traces

Official endpoint: GET /v2/threads/{thread_id}/traces
**Alpha:** The request and response contract may change; Retrieve all traces belonging to a specific thread within a project.';
    protected const PARAMETERS = array (
  'thread_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `thread_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: cursor, filter, page_size, project_id, selects.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `cursor`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'page_size' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `page_size`.',
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
    protected const PATH = '/v2/threads/{thread_id}/traces';
    protected const PATH_PARAMS = array (
  0 => 'thread_id',
);
    protected const QUERY_KEYS = array (
  0 => 'cursor',
  1 => 'filter',
  2 => 'page_size',
  3 => 'project_id',
  4 => 'selects',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
