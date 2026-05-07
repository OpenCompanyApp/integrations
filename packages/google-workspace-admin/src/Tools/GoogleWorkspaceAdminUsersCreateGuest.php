<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Create Guest.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/users:createGuest.
 */
class GoogleWorkspaceAdminUsersCreateGuest extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_create_guest';
    protected const DESCRIPTION = 'Users Create Guest

Official Workspace Admin endpoint: POST /admin/directory/v1/users:createGuest
Create a guest user with access to a [subset of Workspace capabilities](https://support.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `DirectoryUsersCreateGuestRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/users:createGuest';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}