<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Rule.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/runs/rules/{rule_id}.
 */
class LangSmithUpdateRule extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_rule';
    protected const DESCRIPTION = 'Update Rule

Official endpoint: PATCH /api/v1/runs/rules/{rule_id}
Update a run rule.';
    protected const PARAMETERS = array (
  'rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `rule_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/runs/rules/{rule_id}';
    protected const PATH_PARAMS = array (
  0 => 'rule_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
