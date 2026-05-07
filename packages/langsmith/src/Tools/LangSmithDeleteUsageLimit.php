<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Usage Limit.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/usage-limits/{usage_limit_id}.
 */
class LangSmithDeleteUsageLimit extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_usage_limit';
    protected const DESCRIPTION = 'Delete Usage Limit

Official endpoint: DELETE /api/v1/usage-limits/{usage_limit_id}
Delete a specific usage limit.';
    protected const PARAMETERS = array (
  'usage_limit_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `usage_limit_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/usage-limits/{usage_limit_id}';
    protected const PATH_PARAMS = array (
  0 => 'usage_limit_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
