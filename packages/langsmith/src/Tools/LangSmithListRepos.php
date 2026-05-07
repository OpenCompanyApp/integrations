<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Repos.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos.
 */
class LangSmithListRepos extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_repos';
    protected const DESCRIPTION = 'List Repos

Official endpoint: GET /api/v1/repos
Get all repos.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `query`.',
  ),
  'with_latest_manifest' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `with_latest_manifest`.',
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
  'tenant_handle' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tenant_handle`.',
  ),
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tenant_id`.',
  ),
  'has_commits' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `has_commits`.',
  ),
  'tags' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tags`.',
  ),
  'is_archived' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `is_archived`.',
  ),
  'is_public' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `is_public`.',
  ),
  'upstream_repo_owner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `upstream_repo_owner`.',
  ),
  'upstream_repo_handle' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `upstream_repo_handle`.',
  ),
  'tag_value_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag_value_id`.',
  ),
  'repo_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `repo_type`.',
  ),
  'repo_types' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `repo_types`.',
  ),
  'sort_field' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_field`.',
  ),
  'sort_direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_direction`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/repos';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'with_latest_manifest',
  1 => 'limit',
  2 => 'offset',
  3 => 'tenant_handle',
  4 => 'tenant_id',
  5 => 'query',
  6 => 'has_commits',
  7 => 'tags',
  8 => 'is_archived',
  9 => 'is_public',
  10 => 'upstream_repo_owner',
  11 => 'upstream_repo_handle',
  12 => 'tag_value_id',
  13 => 'repo_type',
  14 => 'repo_types',
  15 => 'sort_field',
  16 => 'sort_direction',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
