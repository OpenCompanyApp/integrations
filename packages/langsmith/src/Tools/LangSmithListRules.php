<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Rules.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/runs/rules.
 */
class LangSmithListRules extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_rules';
    protected const DESCRIPTION = 'List Rules

Official endpoint: GET /api/v1/runs/rules
List all run rules.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: dataset_id, session_id, type, name_contains, id, evaluator_id, tag_value_id, include_backfill_progress.',
  ),
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dataset_id`.',
  ),
  'session_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `session_id`.',
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
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `id`.',
  ),
  'evaluator_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `evaluator_id`.',
  ),
  'tag_value_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag_value_id`.',
  ),
  'include_backfill_progress' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_backfill_progress`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/runs/rules';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'dataset_id',
  1 => 'session_id',
  2 => 'type',
  3 => 'name_contains',
  4 => 'id',
  5 => 'evaluator_id',
  6 => 'tag_value_id',
  7 => 'include_backfill_progress',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
