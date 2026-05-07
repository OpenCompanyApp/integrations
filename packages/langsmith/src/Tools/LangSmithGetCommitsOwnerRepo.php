<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List commits.
 *
 * Maps to the official LangSmith endpoint GET /commits/{owner}/{repo}.
 */
class LangSmithGetCommitsOwnerRepo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_commits_owner_repo';
    protected const DESCRIPTION = 'List commits

Official endpoint: GET /commits/{owner}/{repo}
Lists all commits for a repository with pagination support. This endpoint supports both authenticated and unauthenticated access. Authenticated users can access private repos, while unauthenticated users can only access public repos. The include_stats parameter controls whether download and view statistics are computed (defaults to true).';
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
    'description' => 'Query string parameters. Known keys: include_stats, limit, offset, tag.',
  ),
  'include_stats' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_stats`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'tag' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/commits/{owner}/{repo}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
  0 => 'include_stats',
  1 => 'limit',
  2 => 'offset',
  3 => 'tag',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
