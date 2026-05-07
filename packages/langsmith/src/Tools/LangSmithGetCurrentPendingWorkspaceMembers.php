<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current Pending Workspace Members.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/members/pending.
 */
class LangSmithGetCurrentPendingWorkspaceMembers extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_pending_workspace_members';
    protected const DESCRIPTION = 'Get Current Pending Workspace Members

Official endpoint: GET /api/v1/workspaces/current/members/pending
Get Current Pending Workspace Members.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset, emails, q, sort_by_desc, sort_by.',
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
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/members/pending';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'emails',
  3 => 'q',
  4 => 'sort_by_desc',
  5 => 'sort_by',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
