<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Members Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/groups/{groupKey}/members/{memberKey}.
 */
class GoogleWorkspaceAdminMembersGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_members_get';
    protected const DESCRIPTION = 'Members Get

Official Workspace Admin endpoint: GET /admin/directory/v1/groups/{groupKey}/members/{memberKey}
Retrieves a group member\'s properties.';
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
    protected const METHOD = 'GET';
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