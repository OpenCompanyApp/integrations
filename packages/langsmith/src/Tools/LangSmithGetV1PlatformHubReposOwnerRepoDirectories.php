<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get directory contents.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/hub/repos/{owner}/{repo}/directories.
 */
class LangSmithGetV1PlatformHubReposOwnerRepoDirectories extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_hub_repos_owner_repo_directories';
    protected const DESCRIPTION = 'Get directory contents

Official endpoint: GET /v1/platform/hub/repos/{owner}/{repo}/directories
Resolves the flattened file tree for an agent or skill repository at a specific commit, tag, or latest.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: commit.',
  ),
  'commit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `commit`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/hub/repos/{owner}/{repo}/directories';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
  0 => 'commit',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
