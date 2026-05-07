<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Rule.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/rules.
 */
class LangSmithCreateRule extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_rule';
    protected const DESCRIPTION = 'Create Rule

Official endpoint: POST /api/v1/runs/rules
Create a new run rule.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/rules';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
