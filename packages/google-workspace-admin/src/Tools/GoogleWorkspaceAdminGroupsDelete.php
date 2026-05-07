<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Groups Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/groups/{groupKey}.
 */
class GoogleWorkspaceAdminGroupsDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_groups_delete';
    protected const DESCRIPTION = 'Groups Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/groups/{groupKey}
Deletes a group.';
    protected const PARAMETERS = array (
  'groupKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/groups/{groupKey}';
    protected const PATH_PARAMS = array (
  0 => 'groupKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}