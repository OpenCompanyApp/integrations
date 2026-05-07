<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Tracer Session.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/sessions/{session_id}.
 */
class LangSmithUpdateTracerSession extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_tracer_session';
    protected const DESCRIPTION = 'Update Tracer Session

Official endpoint: PATCH /api/v1/sessions/{session_id}
Update a session.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/sessions/{session_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
