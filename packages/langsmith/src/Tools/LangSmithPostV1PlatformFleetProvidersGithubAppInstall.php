<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get GitHub App install link.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/fleet/providers/github-app/install.
 */
class LangSmithPostV1PlatformFleetProvidersGithubAppInstall extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_fleet_providers_github_app_install';
    protected const DESCRIPTION = 'Get GitHub App install link

Official endpoint: POST /v1/platform/fleet/providers/github-app/install
Generate a link to install the GitHub App for the current organization.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/fleet/providers/github-app/install';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
