<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Re-invite a member.
 *
 * Maps to the official Bitwarden Public API endpoint post /public/members/{id}/reinvite.
 */
class BitwardenMembersPostReinvite extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_post_reinvite';
    protected const DESCRIPTION = 'Re-invite a member.

Official Bitwarden Public API endpoint: POST /public/members/{id}/reinvite

Re-sends the invitation email to an organization member.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the member to re-invite.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/public/members/{id}/reinvite';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
