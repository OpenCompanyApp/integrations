<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create directory commit.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/hub/repos/{owner}/{repo}/directories/commits.
 */
class LangSmithPostV1PlatformHubReposOwnerRepoDirectoriesCommits extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_hub_repos_owner_repo_directories_commits';
    protected const DESCRIPTION = 'Create directory commit

Official endpoint: POST /v1/platform/hub/repos/{owner}/{repo}/directories/commits
Creates a new directory commit for an agent or skill repository by applying file/link create, update, and delete operations.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/hub/repos/{owner}/{repo}/directories/commits';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
