<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Photos Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/users/{userKey}/photos/thumbnail.
 */
class GoogleWorkspaceAdminUsersPhotosGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_photos_get';
    protected const DESCRIPTION = 'Users Photos Get

Official Workspace Admin endpoint: GET /admin/directory/v1/users/{userKey}/photos/thumbnail
Retrieves the user\'s photo.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
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