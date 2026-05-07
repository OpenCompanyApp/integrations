<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Remove a member.
 *
 * Maps to the official Bitwarden Public API endpoint delete /public/members/{id}.
 */
class BitwardenMembersRemove extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_remove';
    protected const DESCRIPTION = 'Remove a member.

Official Bitwarden Public API endpoint: DELETE /public/members/{id}

Removes a member from the organization. This cannot be undone. The user account will still remain.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the member to be removed.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/public/members/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
