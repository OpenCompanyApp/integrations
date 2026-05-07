<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Resend an invitation.
 *
 * Maps to the official WorkOS endpoint post /user_management/invitations/{id}/resend.
 */
class WorkOSUserlandUserInvitesResend extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_invites_resend';
    protected const DESCRIPTION = 'Resend an invitation

Official WorkOS endpoint: POST /user_management/invitations/{id}/resend

Resends an invitation email to the recipient. The invitation must be in a pending state.';
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
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/invitations/{id}/resend';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
