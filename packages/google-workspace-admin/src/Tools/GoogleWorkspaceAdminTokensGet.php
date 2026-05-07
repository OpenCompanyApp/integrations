<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Tokens Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/users/{userKey}/tokens/{clientId}.
 */
class GoogleWorkspaceAdminTokensGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_tokens_get';
    protected const DESCRIPTION = 'Tokens Get

Official Workspace Admin endpoint: GET /admin/directory/v1/users/{userKey}/tokens/{clientId}
Gets information about an access token issued by a user.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'clientId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `clientId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/users/{userKey}/tokens/{clientId}';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
  1 => 'clientId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}