<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current Workspace Usage Limits Info.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/usage_limits.
 */
class LangSmithGetCurrentWorkspaceUsageLimitsInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_workspace_usage_limits_info';
    protected const DESCRIPTION = 'Get Current Workspace Usage Limits Info

Official endpoint: GET /api/v1/workspaces/current/usage_limits
Get Current Workspace Usage Limits Info.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/usage_limits';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
