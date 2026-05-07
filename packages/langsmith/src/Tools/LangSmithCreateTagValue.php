<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Tag Value.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values.
 */
class LangSmithCreateTagValue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_tag_value';
    protected const DESCRIPTION = 'Create Tag Value

Official endpoint: POST /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values
Create Tag Value.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values';
    protected const PATH_PARAMS = array (
  0 => 'tag_key_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
