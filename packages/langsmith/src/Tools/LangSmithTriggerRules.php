<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Trigger Rules.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/rules/trigger.
 */
class LangSmithTriggerRules extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_trigger_rules';
    protected const DESCRIPTION = 'Trigger Rules

Official endpoint: POST /api/v1/runs/rules/trigger
Trigger an array of run rules manually.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/rules/trigger';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
