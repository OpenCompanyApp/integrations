<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Upsert Usage Limit.
 *
 * Maps to the official LangSmith endpoint PUT /api/v1/usage-limits.
 */
class LangSmithUpsertUsageLimit extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_upsert_usage_limit';
    protected const DESCRIPTION = 'Upsert Usage Limit

Official endpoint: PUT /api/v1/usage-limits
Create a new usage limit.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/usage-limits';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
