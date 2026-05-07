<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Groups Update.
 *
 * Maps to the official Workspace Admin endpoint PUT /admin/directory/v1/groups/{groupKey}.
 */
class GoogleWorkspaceAdminGroupsUpdate extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_groups_update';
    protected const DESCRIPTION = 'Groups Update

Official Workspace Admin endpoint: PUT /admin/directory/v1/groups/{groupKey}
Updates a group\'s properties.';
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
    'description' => 'JSON request body matching the official Workspace Admin `Group` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/admin/directory/v1/groups/{groupKey}';
    protected const PATH_PARAMS = array (
  0 => 'groupKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}