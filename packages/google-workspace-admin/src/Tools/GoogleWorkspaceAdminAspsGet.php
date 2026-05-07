<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Asps Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/users/{userKey}/asps/{codeId}.
 */
class GoogleWorkspaceAdminAspsGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_asps_get';
    protected const DESCRIPTION = 'Asps Get

Official Workspace Admin endpoint: GET /admin/directory/v1/users/{userKey}/asps/{codeId}
Gets information about an ASP issued by a user.';
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
    protected const METHOD = 'GET';
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