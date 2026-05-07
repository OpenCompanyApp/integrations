<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Tracer Sessions Runs Metadata.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sessions/{session_id}/metadata.
 */
class LangSmithReadTracerSessionsRunsMetadata extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_tracer_sessions_runs_metadata';
    protected const DESCRIPTION = 'Read Tracer Sessions Runs Metadata

Official endpoint: GET /api/v1/sessions/{session_id}/metadata
Given a session, a number K, and (optionally) a list of metadata keys, return the top K values for each key.';
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
    'description' => 'Query string parameters. Known keys: metadata_keys, start_time, k, root_runs_only.',
  ),
  'metadata_keys' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `metadata_keys`.',
  ),
  'start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `start_time`.',
  ),
  'k' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `k`.',
  ),
  'root_runs_only' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `root_runs_only`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sessions/{session_id}/metadata';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
  0 => 'metadata_keys',
  1 => 'start_time',
  2 => 'k',
  3 => 'root_runs_only',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
