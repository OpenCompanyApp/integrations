<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete a GitHub App installation.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/fleet/providers/github-app/installations/{id}.
 */
class LangSmithDeleteV1PlatformFleetProvidersGithubAppInstallationsId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_fleet_providers_github_app_installations_id';
    protected const DESCRIPTION = 'Delete a GitHub App installation

Official endpoint: DELETE /v1/platform/fleet/providers/github-app/installations/{id}
Remove a GitHub App installation link for the current user.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/fleet/providers/github-app/installations/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
