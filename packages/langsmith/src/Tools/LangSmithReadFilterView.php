<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Filter View.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sessions/{session_id}/views/{view_id}.
 */
class LangSmithReadFilterView extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_filter_view';
    protected const DESCRIPTION = 'Read Filter View

Official endpoint: GET /api/v1/sessions/{session_id}/views/{view_id}
Get a specific filter view.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
  'view_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `view_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sessions/{session_id}/views/{view_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'view_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
