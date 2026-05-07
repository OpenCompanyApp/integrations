<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Members Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/groups/{groupKey}/members/{memberKey}.
 */
class GoogleWorkspaceAdminMembersDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_members_delete';
    protected const DESCRIPTION = 'Members Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/groups/{groupKey}/members/{memberKey}
Removes a member from a group.';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/groups/{groupKey}/members/{memberKey}';
    protected const PATH_PARAMS = array (
  0 => 'groupKey',
  1 => 'memberKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}