<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get GitHub OAuth authorization link.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/fleet/providers/github-app/auth.
 */
class LangSmithPostV1PlatformFleetProvidersGithubAppAuth extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_fleet_providers_github_app_auth';
    protected const DESCRIPTION = 'Get GitHub OAuth authorization link

Official endpoint: POST /v1/platform/fleet/providers/github-app/auth
Generate a GitHub OAuth link for the current user to connect their GitHub account.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/fleet/providers/github-app/auth';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
