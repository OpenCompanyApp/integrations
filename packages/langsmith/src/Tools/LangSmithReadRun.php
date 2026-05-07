<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Run.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/runs/{run_id}.
 */
class LangSmithReadRun extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_run';
    protected const DESCRIPTION = 'Read Run

Official endpoint: GET /api/v1/runs/{run_id}
Get a specific run.';
    protected const PARAMETERS = array (
  'run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `run_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: session_id, start_time, exclude_s3_stored_attributes, exclude_serialized, include_messages.',
  ),
  'session_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `session_id`.',
  ),
  'start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `start_time`.',
  ),
  'exclude_s3_stored_attributes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `exclude_s3_stored_attributes`.',
  ),
  'exclude_serialized' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `exclude_serialized`.',
  ),
  'include_messages' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_messages`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/runs/{run_id}';
    protected const PATH_PARAMS = array (
  0 => 'run_id',
);
    protected const QUERY_KEYS = array (
  0 => 'session_id',
  1 => 'start_time',
  2 => 'exclude_s3_stored_attributes',
  3 => 'exclude_serialized',
  4 => 'include_messages',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
