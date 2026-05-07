<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List repositories for a GitHub App installation.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/fleet/providers/github-app/installations/{id}/repos.
 */
class LangSmithGetV1PlatformFleetProvidersGithubAppInstallationsIdRepos extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_fleet_providers_github_app_installations_id_repos';
    protected const DESCRIPTION = 'List repositories for a GitHub App installation

Official endpoint: GET /v1/platform/fleet/providers/github-app/installations/{id}/repos
Return repositories accessible to the specified GitHub App installation.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/fleet/providers/github-app/installations/{id}/repos';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
