<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Thread Preview.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/runs/threads/{thread_id}.
 */
class LangSmithThreadPreview extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_thread_preview';
    protected const DESCRIPTION = 'Thread Preview

Official endpoint: GET /api/v1/runs/threads/{thread_id}
Get preview of a thread.';
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
    'description' => 'Query string parameters. Known keys: session_id, select, variables.',
  ),
  'session_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `session_id`.',
  ),
  'select' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `select`.',
  ),
  'variables' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `variables`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/runs/threads/{thread_id}';
    protected const PATH_PARAMS = array (
  0 => 'thread_id',
);
    protected const QUERY_KEYS = array (
  0 => 'session_id',
  1 => 'select',
  2 => 'variables',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
