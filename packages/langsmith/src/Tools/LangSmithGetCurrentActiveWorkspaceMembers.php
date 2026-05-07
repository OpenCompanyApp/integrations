<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current Active Workspace Members.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/members/active.
 */
class LangSmithGetCurrentActiveWorkspaceMembers extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_active_workspace_members';
    protected const DESCRIPTION = 'Get Current Active Workspace Members

Official endpoint: GET /api/v1/workspaces/current/members/active
Get Current Active Workspace Members.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset, emails, q, sort_by_desc, ls_user_ids, user_ids, is_disabled, sort_by.',
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
  'emails' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `emails`.',
  ),
  'q' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `q`.',
  ),
  'sort_by_desc' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by_desc`.',
  ),
  'ls_user_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ls_user_ids`.',
  ),
  'user_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `user_ids`.',
  ),
  'is_disabled' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `is_disabled`.',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/members/active';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'emails',
  3 => 'q',
  4 => 'sort_by_desc',
  5 => 'ls_user_ids',
  6 => 'user_ids',
  7 => 'is_disabled',
  8 => 'sort_by',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
