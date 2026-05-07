<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Tag Key.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/tag-keys/{tag_key_id}.
 */
class LangSmithGetTagKey extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_tag_key';
    protected const DESCRIPTION = 'Get Tag Key

Official endpoint: GET /api/v1/workspaces/current/tag-keys/{tag_key_id}
Get Tag Key.';
    protected const PARAMETERS = array (
  'tag_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_key_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/tag-keys/{tag_key_id}';
    protected const PATH_PARAMS = array (
  0 => 'tag_key_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
