<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Members Insert.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/groups/{groupKey}/members.
 */
class GoogleWorkspaceAdminMembersInsert extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_members_insert';
    protected const DESCRIPTION = 'Members Insert

Official Workspace Admin endpoint: POST /admin/directory/v1/groups/{groupKey}/members
Adds a user to the specified group.';
    protected const PARAMETERS = array (
  'groupKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Member` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/groups/{groupKey}/members';
    protected const PATH_PARAMS = array (
  0 => 'groupKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}