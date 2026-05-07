<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Request a GitHub access token.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/fleet/providers/github-app/tokens.
 */
class LangSmithPostV1PlatformFleetProvidersGithubAppTokens extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_fleet_providers_github_app_tokens';
    protected const DESCRIPTION = 'Request a GitHub access token

Official endpoint: POST /v1/platform/fleet/providers/github-app/tokens
Return a short-lived GitHub access token scoped to the given repository.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/fleet/providers/github-app/tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
