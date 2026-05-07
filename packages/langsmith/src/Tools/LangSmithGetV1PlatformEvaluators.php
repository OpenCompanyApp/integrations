<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List evaluators.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/evaluators.
 */
class LangSmithGetV1PlatformEvaluators extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_evaluators';
    protected const DESCRIPTION = 'List evaluators

Official endpoint: GET /v1/platform/evaluators
List evaluators for the current workspace, with optional filtering by type, name, tag, feedback key, or resource ID.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: type, name_contains, tag_value_id, feedback_key, resource_id, sort_by, sort_by_desc, limit, offset.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `type`.',
  ),
  'name_contains' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name_contains`.',
  ),
  'tag_value_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag_value_id`.',
  ),
  'feedback_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `feedback_key`.',
  ),
  'resource_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `resource_id`.',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by`.',
  ),
  'sort_by_desc' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by_desc`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/evaluators';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'type',
  1 => 'name_contains',
  2 => 'tag_value_id',
  3 => 'feedback_key',
  4 => 'resource_id',
  5 => 'sort_by',
  6 => 'sort_by_desc',
  7 => 'limit',
  8 => 'offset',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
