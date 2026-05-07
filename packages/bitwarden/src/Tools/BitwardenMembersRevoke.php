<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Revoke a member's access to an organization.
 *
 * Maps to the official Bitwarden Public API endpoint post /public/members/{id}/revoke.
 */
class BitwardenMembersRevoke extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_revoke';
    protected const DESCRIPTION = 'Revoke a member\'s access to an organization.

Official Bitwarden Public API endpoint: POST /public/members/{id}/revoke

Revoke a member\'s access to an organization.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The ID of the member to be revoked.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/public/members/{id}/revoke';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
