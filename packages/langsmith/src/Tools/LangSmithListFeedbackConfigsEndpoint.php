<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Feedback Configs Endpoint.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/feedback-configs.
 */
class LangSmithListFeedbackConfigsEndpoint extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_feedback_configs_endpoint';
    protected const DESCRIPTION = 'List Feedback Configs Endpoint

Official endpoint: GET /api/v1/feedback-configs
List Feedback Configs Endpoint.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: key, name_contains, offset, limit, sort_by_desc, read_after_write.',
  ),
  'key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `key`.',
  ),
  'name_contains' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name_contains`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'sort_by_desc' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by_desc`.',
  ),
  'read_after_write' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `read_after_write`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/feedback-configs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'key',
  1 => 'name_contains',
  2 => 'offset',
  3 => 'limit',
  4 => 'sort_by_desc',
  5 => 'read_after_write',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
