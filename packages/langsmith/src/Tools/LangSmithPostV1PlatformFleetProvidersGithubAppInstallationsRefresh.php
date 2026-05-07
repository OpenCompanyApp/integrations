<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Refresh GitHub App installations.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/fleet/providers/github-app/installations/refresh.
 */
class LangSmithPostV1PlatformFleetProvidersGithubAppInstallationsRefresh extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_fleet_providers_github_app_installations_refresh';
    protected const DESCRIPTION = 'Refresh GitHub App installations

Official endpoint: POST /v1/platform/fleet/providers/github-app/installations/refresh
Trigger a live sync with GitHub for the current user\'s GitHub App installations. Upserts new installations, deletes stale ones, and returns the refreshed list. Requires an existing GitHub connection.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/fleet/providers/github-app/installations/refresh';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
