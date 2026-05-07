<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Trigger Rule.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/rules/{rule_id}/trigger.
 */
class LangSmithTriggerRule extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_trigger_rule';
    protected const DESCRIPTION = 'Trigger Rule

Official endpoint: POST /api/v1/runs/rules/{rule_id}/trigger
Trigger a run rule manually.';
    protected const PARAMETERS = array (
  'rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `rule_id`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/rules/{rule_id}/trigger';
    protected const PATH_PARAMS = array (
  0 => 'rule_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
