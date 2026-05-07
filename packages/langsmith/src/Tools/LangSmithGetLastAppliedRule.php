<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Last Applied Rule.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/runs/rules/{rule_id}/last_applied.
 */
class LangSmithGetLastAppliedRule extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_last_applied_rule';
    protected const DESCRIPTION = 'Get Last Applied Rule

Official endpoint: GET /api/v1/runs/rules/{rule_id}/last_applied
Get the last applied rule.';
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
    'description' => 'Query string parameters. Known keys: backfill.',
  ),
  'backfill' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `backfill`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/runs/rules/{rule_id}/last_applied';
    protected const PATH_PARAMS = array (
  0 => 'rule_id',
);
    protected const QUERY_KEYS = array (
  0 => 'backfill',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
