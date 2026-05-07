<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete directory repository.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/hub/repos/{owner}/{repo}/directories.
 */
class LangSmithDeleteV1PlatformHubReposOwnerRepoDirectories extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_hub_repos_owner_repo_directories';
    protected const DESCRIPTION = 'Delete directory repository

Official endpoint: DELETE /v1/platform/hub/repos/{owner}/{repo}/directories
Deletes an agent or skill repository and its owned child file repositories.';
    protected const PARAMETERS = array (
  'owner' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `owner`.',
  ),
  'repo' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `repo`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/hub/repos/{owner}/{repo}/directories';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
