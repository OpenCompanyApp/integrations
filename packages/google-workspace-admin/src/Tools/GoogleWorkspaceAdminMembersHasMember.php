<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Members Has Member.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/groups/{groupKey}/hasMember/{memberKey}.
 */
class GoogleWorkspaceAdminMembersHasMember extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_members_has_member';
    protected const DESCRIPTION = 'Members Has Member

Official Workspace Admin endpoint: GET /admin/directory/v1/groups/{groupKey}/hasMember/{memberKey}
Checks whether the given user is a member of the group.';
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
    protected const PATH = '/admin/directory/v1/groups/{groupKey}/hasMember/{memberKey}';
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