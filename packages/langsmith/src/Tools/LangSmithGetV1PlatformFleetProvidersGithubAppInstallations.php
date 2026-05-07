<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List GitHub App installations.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/fleet/providers/github-app/installations.
 */
class LangSmithGetV1PlatformFleetProvidersGithubAppInstallations extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_fleet_providers_github_app_installations';
    protected const DESCRIPTION = 'List GitHub App installations

Official endpoint: GET /v1/platform/fleet/providers/github-app/installations
Return GitHub App installations linked to the current user from our database. This is a cache — it does not hit the GitHub API. Use POST /installations/refresh to force a fresh sync from GitHub.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/fleet/providers/github-app/installations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
