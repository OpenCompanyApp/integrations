<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Members List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/groups/{groupKey}/members.
 */
class GoogleWorkspaceAdminMembersList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_members_list';
    protected const DESCRIPTION = 'Members List

Official Workspace Admin endpoint: GET /admin/directory/v1/groups/{groupKey}/members
Retrieves a paginated list of all members in a group.';
    protected const PARAMETERS = array (
  'groupKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: includeDerivedMembership, pageToken, roles, maxResults.',
  ),
  'includeDerivedMembership' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `includeDerivedMembership`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'roles' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `roles`.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/groups/{groupKey}/members';
    protected const PATH_PARAMS = array (
  0 => 'groupKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'includeDerivedMembership',
  1 => 'pageToken',
  2 => 'roles',
  3 => 'maxResults',
);
    protected const BODY_REQUIRED = false;
}