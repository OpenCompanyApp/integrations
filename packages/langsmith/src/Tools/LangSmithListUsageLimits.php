<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Usage Limits.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/usage-limits.
 */
class LangSmithListUsageLimits extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_usage_limits';
    protected const DESCRIPTION = 'List Usage Limits

Official endpoint: GET /api/v1/usage-limits
List out the configured usage limits for a given tenant.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/usage-limits';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
