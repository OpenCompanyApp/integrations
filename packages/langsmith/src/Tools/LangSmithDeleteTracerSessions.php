<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Tracer Sessions.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/sessions.
 */
class LangSmithDeleteTracerSessions extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_tracer_sessions';
    protected const DESCRIPTION = 'Delete Tracer Sessions

Official endpoint: DELETE /api/v1/sessions
Delete sessions.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: session_ids.',
  ),
  'session_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `session_ids`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/sessions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'session_ids',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
