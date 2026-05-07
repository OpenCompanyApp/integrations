<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Filter Views.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sessions/{session_id}/views.
 */
class LangSmithReadFilterViews extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_filter_views';
    protected const DESCRIPTION = 'Read Filter Views

Official endpoint: GET /api/v1/sessions/{session_id}/views
Get all filter views for a session.';
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
    'description' => 'Query string parameters. Known keys: type.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `type`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sessions/{session_id}/views';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
  0 => 'type',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
