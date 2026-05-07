<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Tokens Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/users/{userKey}/tokens/{clientId}.
 */
class GoogleWorkspaceAdminTokensDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_tokens_delete';
    protected const DESCRIPTION = 'Tokens Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/users/{userKey}/tokens/{clientId}
Deletes all access tokens issued by a user for an application.';
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
    protected const METHOD = 'DELETE';
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