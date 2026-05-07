<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Tag Values.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values.
 */
class LangSmithListTagValues extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_tag_values';
    protected const DESCRIPTION = 'List Tag Values

Official endpoint: GET /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values
List Tag Values.';
    protected const PARAMETERS = array (
  'tag_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_key_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values';
    protected const PATH_PARAMS = array (
  0 => 'tag_key_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
