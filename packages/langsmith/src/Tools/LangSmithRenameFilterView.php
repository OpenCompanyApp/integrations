<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Rename Filter View.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/sessions/{session_id}/views/{view_id}/rename.
 */
class LangSmithRenameFilterView extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_rename_filter_view';
    protected const DESCRIPTION = 'Rename Filter View

Official endpoint: PATCH /api/v1/sessions/{session_id}/views/{view_id}/rename
Rename a filter view (display_name and description only).';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/sessions/{session_id}/views/{view_id}/rename';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'view_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
