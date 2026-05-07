<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Tracer Session.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sessions/{session_id}.
 */
class LangSmithReadTracerSession extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_tracer_session';
    protected const DESCRIPTION = 'Read Tracer Session

Official endpoint: GET /api/v1/sessions/{session_id}
Get a specific session.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: include_stats, stats_start_time.',
  ),
  'include_stats' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_stats`.',
  ),
  'stats_start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `stats_start_time`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sessions/{session_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
  0 => 'include_stats',
  1 => 'stats_start_time',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
