<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Repo Tags.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos/tags.
 */
class LangSmithListRepoTags extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_repo_tags';
    protected const DESCRIPTION = 'List Repo Tags

Official endpoint: GET /api/v1/repos/tags
Get all repo tags.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `query`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/repos/tags';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'tenant_handle',
  3 => 'tenant_id',
  4 => 'query',
  5 => 'has_commits',
  6 => 'tags',
  7 => 'is_archived',
  8 => 'is_public',
  9 => 'upstream_repo_owner',
  10 => 'upstream_repo_handle',
  11 => 'tag_value_id',
  12 => 'repo_type',
  13 => 'repo_types',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
