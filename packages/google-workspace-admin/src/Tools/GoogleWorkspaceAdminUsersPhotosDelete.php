<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Photos Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/users/{userKey}/photos/thumbnail.
 */
class GoogleWorkspaceAdminUsersPhotosDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_photos_delete';
    protected const DESCRIPTION = 'Users Photos Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/users/{userKey}/photos/thumbnail
Removes the user\'s photo.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/users/{userKey}/photos/thumbnail';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}