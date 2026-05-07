<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List org members with workspace roles.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/orgs/current/members.
 */
class LangSmithGetV1PlatformOrgsCurrentMembers extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_orgs_current_members';
    protected const DESCRIPTION = 'List org members with workspace roles

Official endpoint: GET /v1/platform/orgs/current/members
Returns a paginated list of org members (active and pending) enriched with workspace memberships.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset, active_is, pending_is, name_like, email_like, workspace_name_like, organization_role_like, workspace_role_like.',
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
  'active_is' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `active_is`.',
  ),
  'pending_is' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pending_is`.',
  ),
  'name_like' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name_like`.',
  ),
  'email_like' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `email_like`.',
  ),
  'workspace_name_like' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `workspace_name_like`.',
  ),
  'organization_role_like' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `organization_role_like`.',
  ),
  'workspace_role_like' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `workspace_role_like`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/orgs/current/members';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'active_is',
  3 => 'pending_is',
  4 => 'name_like',
  5 => 'email_like',
  6 => 'workspace_name_like',
  7 => 'organization_role_like',
  8 => 'workspace_role_like',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
