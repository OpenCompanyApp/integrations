<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Restore a member.
 *
 * Maps to the official Bitwarden Public API endpoint post /public/members/{id}/restore.
 */
class BitwardenMembersRestore extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_restore';
    protected const DESCRIPTION = 'Restore a member.

Official Bitwarden Public API endpoint: POST /public/members/{id}/restore

Restores a previously revoked member of the organization.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the member to be restored.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/public/members/{id}/restore';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
