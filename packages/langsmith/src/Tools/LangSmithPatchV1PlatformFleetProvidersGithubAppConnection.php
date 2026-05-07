<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update GitHub user connection.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/platform/fleet/providers/github-app/connection.
 */
class LangSmithPatchV1PlatformFleetProvidersGithubAppConnection extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_platform_fleet_providers_github_app_connection';
    protected const DESCRIPTION = 'Update GitHub user connection

Official endpoint: PATCH /v1/platform/fleet/providers/github-app/connection
Update the actor preference for the current user\'s GitHub connection.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/platform/fleet/providers/github-app/connection';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
