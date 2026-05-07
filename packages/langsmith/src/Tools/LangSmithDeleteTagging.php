<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Tagging.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/workspaces/current/taggings/{tagging_id}.
 */
class LangSmithDeleteTagging extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_tagging';
    protected const DESCRIPTION = 'Delete Tagging

Official endpoint: DELETE /api/v1/workspaces/current/taggings/{tagging_id}
Delete Tagging.';
    protected const PARAMETERS = array (
  'tagging_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tagging_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/workspaces/current/taggings/{tagging_id}';
    protected const PATH_PARAMS = array (
  0 => 'tagging_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
