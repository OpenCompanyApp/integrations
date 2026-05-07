<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Groups Aliases Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/groups/{groupKey}/aliases/{alias}.
 */
class GoogleWorkspaceAdminGroupsAliasesDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_groups_aliases_delete';
    protected const DESCRIPTION = 'Groups Aliases Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/groups/{groupKey}/aliases/{alias}
Removes an alias.';
    protected const PARAMETERS = array (
  'groupKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'alias' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `alias`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/groups/{groupKey}/aliases/{alias}';
    protected const PATH_PARAMS = array (
  0 => 'groupKey',
  1 => 'alias',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}