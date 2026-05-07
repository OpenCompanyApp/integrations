<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Tag Key.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/workspaces/current/tag-keys/{tag_key_id}.
 */
class LangSmithDeleteTagKey extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_tag_key';
    protected const DESCRIPTION = 'Delete Tag Key

Official endpoint: DELETE /api/v1/workspaces/current/tag-keys/{tag_key_id}
Delete Tag Key.';
    protected const PARAMETERS = array (
  'tag_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_key_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/workspaces/current/tag-keys/{tag_key_id}';
    protected const PATH_PARAMS = array (
  0 => 'tag_key_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
