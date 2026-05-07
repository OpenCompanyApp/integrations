<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Send an invitation.
 *
 * Maps to the official WorkOS endpoint post /user_management/invitations.
 */
class WorkOSUserlandUserInvitesCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_invites_create';
    protected const DESCRIPTION = 'Send an invitation

Official WorkOS endpoint: POST /user_management/invitations

Sends an invitation email to the recipient.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/invitations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
