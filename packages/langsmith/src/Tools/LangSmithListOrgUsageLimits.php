<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Org Usage Limits.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/usage-limits/org.
 */
class LangSmithListOrgUsageLimits extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_org_usage_limits';
    protected const DESCRIPTION = 'List Org Usage Limits

Official endpoint: GET /api/v1/usage-limits/org
List out the configured usage limits for a given organization.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/usage-limits/org';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
