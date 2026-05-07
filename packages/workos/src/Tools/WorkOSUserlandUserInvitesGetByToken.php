<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Find an invitation by token.
 *
 * Maps to the official WorkOS endpoint get /user_management/invitations/by_token/{token}.
 */
class WorkOSUserlandUserInvitesGetByToken extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_invites_get_by_token';
    protected const DESCRIPTION = 'Find an invitation by token

Official WorkOS endpoint: GET /user_management/invitations/by_token/{token}

Retrieve an existing invitation using the token.';
    protected const PARAMETERS = array (
  'token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `token` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/invitations/by_token/{token}';
    protected const PATH_PARAMS = array (
  'token' => 'token',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
