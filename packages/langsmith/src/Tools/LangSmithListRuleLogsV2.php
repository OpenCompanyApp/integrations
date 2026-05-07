<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Rule Logs V2.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/runs/rules/{rule_id}/logs/v2.
 */
class LangSmithListRuleLogsV2 extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_rule_logs_v2';
    protected const DESCRIPTION = 'List Rule Logs V2

Official endpoint: GET /api/v1/runs/rules/{rule_id}/logs/v2
List logs for a particular rule with cursor-based pagination. This endpoint handles S3-stored outcomes correctly by using run_outcomes_count to predict batch sizes and avoid over-fetching.';
    protected const PARAMETERS = array (
  'rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `rule_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, cursor, backfill, start_time, end_time, session_id.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `cursor`.',
  ),
  'backfill' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `backfill`.',
  ),
  'start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `start_time`.',
  ),
  'end_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `end_time`.',
  ),
  'session_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `session_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/runs/rules/{rule_id}/logs/v2';
    protected const PATH_PARAMS = array (
  0 => 'rule_id',
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'cursor',
  2 => 'backfill',
  3 => 'start_time',
  4 => 'end_time',
  5 => 'session_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
