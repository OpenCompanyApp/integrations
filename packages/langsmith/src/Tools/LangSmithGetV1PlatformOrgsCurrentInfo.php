<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get current organization info.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/orgs/current/info.
 */
class LangSmithGetV1PlatformOrgsCurrentInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_orgs_current_info';
    protected const DESCRIPTION = 'Get current organization info

Official endpoint: GET /v1/platform/orgs/current/info
Returns organization info for the authenticated user\'s current organization.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/orgs/current/info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
