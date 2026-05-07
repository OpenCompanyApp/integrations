<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Groups Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/groups/{groupKey}.
 */
class GoogleWorkspaceAdminGroupsGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_groups_get';
    protected const DESCRIPTION = 'Groups Get

Official Workspace Admin endpoint: GET /admin/directory/v1/groups/{groupKey}
Retrieves a group\'s properties.';
    protected const PARAMETERS = array (
  'groupKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
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