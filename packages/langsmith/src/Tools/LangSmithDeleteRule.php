<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Rule.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/runs/rules/{rule_id}.
 */
class LangSmithDeleteRule extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_rule';
    protected const DESCRIPTION = 'Delete Rule

Official endpoint: DELETE /api/v1/runs/rules/{rule_id}
Delete a run rule.';
    protected const PARAMETERS = array (
  'rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `rule_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/runs/rules/{rule_id}';
    protected const PATH_PARAMS = array (
  0 => 'rule_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
