<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Photos Patch.
 *
 * Maps to the official Workspace Admin endpoint PATCH /admin/directory/v1/users/{userKey}/photos/thumbnail.
 */
class GoogleWorkspaceAdminUsersPhotosPatch extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_photos_patch';
    protected const DESCRIPTION = 'Users Photos Patch

Official Workspace Admin endpoint: PATCH /admin/directory/v1/users/{userKey}/photos/thumbnail
Adds a photo for the user.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `UserPhoto` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/admin/directory/v1/users/{userKey}/photos/thumbnail';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}