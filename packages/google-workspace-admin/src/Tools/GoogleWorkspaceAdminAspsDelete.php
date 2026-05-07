<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Asps Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/users/{userKey}/asps/{codeId}.
 */
class GoogleWorkspaceAdminAspsDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_asps_delete';
    protected const DESCRIPTION = 'Asps Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/users/{userKey}/asps/{codeId}
Deletes an ASP issued by a user.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'codeId' =>
  array (
    'type' => 'integer',
    'required' => true,
    'description' => 'Path parameter `codeId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/users/{userKey}/asps/{codeId}';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
  1 => 'codeId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}