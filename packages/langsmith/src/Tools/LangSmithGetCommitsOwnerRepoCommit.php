<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get a commit.
 *
 * Maps to the official LangSmith endpoint GET /commits/{owner}/{repo}/{commit}.
 */
class LangSmithGetCommitsOwnerRepoCommit extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_commits_owner_repo_commit';
    protected const DESCRIPTION = 'Get a commit

Official endpoint: GET /commits/{owner}/{repo}/{commit}
Retrieves a specific commit by hash, tag, or "latest" for a repository. This endpoint supports both authenticated and unauthenticated access. Authenticated users can access private repos, while unauthenticated users can only access public repos. Commit resolution logic: - "latest" or empty: Get the most recent commit - Less than 8 characters: Only check for tags - 8 or more characters: Prioritize commit hash over ...';
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
  'commit' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `commit`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: get_examples, include, include_model, is_view.',
  ),
  'get_examples' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `get_examples`.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include`.',
  ),
  'include_model' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_model`.',
  ),
  'is_view' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `is_view`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/commits/{owner}/{repo}/{commit}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
  2 => 'commit',
);
    protected const QUERY_KEYS = array (
  0 => 'get_examples',
  1 => 'include',
  2 => 'include_model',
  3 => 'is_view',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
