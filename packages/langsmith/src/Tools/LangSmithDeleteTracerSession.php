<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Tracer Session.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/sessions/{session_id}.
 */
class LangSmithDeleteTracerSession extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_tracer_session';
    protected const DESCRIPTION = 'Delete Tracer Session

Official endpoint: DELETE /api/v1/sessions/{session_id}
Delete a specific session.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/sessions/{session_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
