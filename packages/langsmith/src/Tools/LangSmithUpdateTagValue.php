<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Tag Value.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values/{tag_value_id}.
 */
class LangSmithUpdateTagValue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_tag_value';
    protected const DESCRIPTION = 'Update Tag Value

Official endpoint: PATCH /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values/{tag_value_id}
Update Tag Value.';
    protected const PARAMETERS = array (
  'tag_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_key_id`.',
  ),
  'tag_value_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_value_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values/{tag_value_id}';
    protected const PATH_PARAMS = array (
  0 => 'tag_key_id',
  1 => 'tag_value_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
