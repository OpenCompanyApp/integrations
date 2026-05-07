<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Tag Value.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values/{tag_value_id}.
 */
class LangSmithDeleteTagValue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_tag_value';
    protected const DESCRIPTION = 'Delete Tag Value

Official endpoint: DELETE /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values/{tag_value_id}
Delete Tag Value.';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values/{tag_value_id}';
    protected const PATH_PARAMS = array (
  0 => 'tag_key_id',
  1 => 'tag_value_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
