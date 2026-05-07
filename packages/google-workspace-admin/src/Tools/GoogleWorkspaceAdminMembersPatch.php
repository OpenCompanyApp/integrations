<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Members Patch.
 *
 * Maps to the official Workspace Admin endpoint PATCH /admin/directory/v1/groups/{groupKey}/members/{memberKey}.
 */
class GoogleWorkspaceAdminMembersPatch extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_members_patch';
    protected const DESCRIPTION = 'Members Patch

Official Workspace Admin endpoint: PATCH /admin/directory/v1/groups/{groupKey}/members/{memberKey}
Updates the membership properties of a user in the specified group.';
    protected const PARAMETERS = array (
  'groupKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'memberKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `memberKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Member` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/admin/directory/v1/groups/{groupKey}/members/{memberKey}';
    protected const PATH_PARAMS = array (
  0 => 'groupKey',
  1 => 'memberKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}