<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get tag transition history.
 *
 * Maps to the official LangSmith endpoint GET /repos/{owner}/{repo}/tags/{tag_name}/history.
 */
class LangSmithGetReposOwnerRepoTagsTagNameHistory extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_repos_owner_repo_tags_tag_name_history';
    protected const DESCRIPTION = 'Get tag transition history

Official endpoint: GET /repos/{owner}/{repo}/tags/{tag_name}/history
Returns the paginated audit log of transitions for a specific tag in a repository. Each entry records a commit change (from_commit → to_commit) along with who performed it.';
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
  'tag_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_name`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/repos/{owner}/{repo}/tags/{tag_name}/history';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
  2 => 'tag_name',
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
