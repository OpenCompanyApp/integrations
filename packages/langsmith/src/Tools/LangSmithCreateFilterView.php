<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Filter View.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/sessions/{session_id}/views.
 */
class LangSmithCreateFilterView extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_filter_view';
    protected const DESCRIPTION = 'Create Filter View

Official endpoint: POST /api/v1/sessions/{session_id}/views
Create a new filter view.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/sessions/{session_id}/views';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
