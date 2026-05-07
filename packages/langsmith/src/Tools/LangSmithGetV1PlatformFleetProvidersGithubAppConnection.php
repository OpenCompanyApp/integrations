<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get GitHub user connection status.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/fleet/providers/github-app/connection.
 */
class LangSmithGetV1PlatformFleetProvidersGithubAppConnection extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_fleet_providers_github_app_connection';
    protected const DESCRIPTION = 'Get GitHub user connection status

Official endpoint: GET /v1/platform/fleet/providers/github-app/connection
Return the current user\'s GitHub connection status and metadata.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/fleet/providers/github-app/connection';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
