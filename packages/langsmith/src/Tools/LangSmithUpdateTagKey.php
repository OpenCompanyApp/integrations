<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Tag Key.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/workspaces/current/tag-keys/{tag_key_id}.
 */
class LangSmithUpdateTagKey extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_tag_key';
    protected const DESCRIPTION = 'Update Tag Key

Official endpoint: PATCH /api/v1/workspaces/current/tag-keys/{tag_key_id}
Update Tag Key.';
    protected const PARAMETERS = array (
  'tag_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_key_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/workspaces/current/tag-keys/{tag_key_id}';
    protected const PATH_PARAMS = array (
  0 => 'tag_key_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
