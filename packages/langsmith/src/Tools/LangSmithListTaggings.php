<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Taggings.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/taggings.
 */
class LangSmithListTaggings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_taggings';
    protected const DESCRIPTION = 'List Taggings

Official endpoint: GET /api/v1/workspaces/current/taggings
List Taggings.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: tag_value_id.',
  ),
  'tag_value_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag_value_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/taggings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'tag_value_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
