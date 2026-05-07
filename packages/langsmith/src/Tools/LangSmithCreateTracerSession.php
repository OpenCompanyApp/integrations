<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Tracer Session.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/sessions.
 */
class LangSmithCreateTracerSession extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_tracer_session';
    protected const DESCRIPTION = 'Create Tracer Session

Official endpoint: POST /api/v1/sessions
Create a new session.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: upsert.',
  ),
  'upsert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `upsert`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/sessions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'upsert',
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
