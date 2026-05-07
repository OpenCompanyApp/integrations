<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Rule Logs.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/runs/rules/{rule_id}/logs.
 */
class LangSmithListRuleLogs extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_rule_logs';
    protected const DESCRIPTION = 'List Rule Logs

Official endpoint: GET /api/v1/runs/rules/{rule_id}/logs
List logs for a particular rule';
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
    'description' => 'Query string parameters. Known keys: limit, offset, start_time, end_time, session_id.',
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
    protected const PATH = '/api/v1/runs/rules/{rule_id}/logs';
    protected const PATH_PARAMS = array (
  0 => 'rule_id',
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'start_time',
  3 => 'end_time',
  4 => 'session_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
