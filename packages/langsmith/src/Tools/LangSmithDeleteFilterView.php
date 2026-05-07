<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Filter View.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/sessions/{session_id}/views/{view_id}.
 */
class LangSmithDeleteFilterView extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_filter_view';
    protected const DESCRIPTION = 'Delete Filter View

Official endpoint: DELETE /api/v1/sessions/{session_id}/views/{view_id}
Delete a specific filter view.';
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
    protected const METHOD = 'DELETE';
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
