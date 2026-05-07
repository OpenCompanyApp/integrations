<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Tags For Resource.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/tags/resource.
 */
class LangSmithListTagsForResource extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_tags_for_resource';
    protected const DESCRIPTION = 'List Tags For Resource

Official endpoint: GET /api/v1/workspaces/current/tags/resource
List Tags For Resource.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: resource_type, resource_id.',
  ),
  'resource_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `resource_type`.',
  ),
  'resource_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `resource_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/tags/resource';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'resource_type',
  1 => 'resource_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
