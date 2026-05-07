<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Handle GitHub App webhook events.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/fleet/providers/github-app/webhooks.
 */
class LangSmithPostV1PlatformFleetProvidersGithubAppWebhooks extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_fleet_providers_github_app_webhooks';
    protected const DESCRIPTION = 'Handle GitHub App webhook events

Official endpoint: POST /v1/platform/fleet/providers/github-app/webhooks
Process GitHub App webhooks (installation lifecycle, installation_repositories). GitHub may deliver the same event more than once; handling re-applies the current repository-selection state and is safe to repeat.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/fleet/providers/github-app/webhooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
