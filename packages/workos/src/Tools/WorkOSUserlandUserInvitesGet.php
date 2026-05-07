<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get an invitation.
 *
 * Maps to the official WorkOS endpoint get /user_management/invitations/{id}.
 */
class WorkOSUserlandUserInvitesGet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_invites_get';
    protected const DESCRIPTION = 'Get an invitation

Official WorkOS endpoint: GET /user_management/invitations/{id}

Get the details of an existing invitation.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/invitations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
