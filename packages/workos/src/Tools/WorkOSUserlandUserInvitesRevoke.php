<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Revoke an invitation.
 *
 * Maps to the official WorkOS endpoint post /user_management/invitations/{id}/revoke.
 */
class WorkOSUserlandUserInvitesRevoke extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_invites_revoke';
    protected const DESCRIPTION = 'Revoke an invitation

Official WorkOS endpoint: POST /user_management/invitations/{id}/revoke

Revokes an existing invitation.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/invitations/{id}/revoke';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
