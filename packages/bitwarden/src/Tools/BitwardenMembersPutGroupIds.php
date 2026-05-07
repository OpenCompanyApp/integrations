<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Update a member's groups.
 *
 * Maps to the official Bitwarden Public API endpoint put /public/members/{id}/group-ids.
 */
class BitwardenMembersPutGroupIds extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_put_group_ids';
    protected const DESCRIPTION = 'Update a member\'s groups.

Official Bitwarden Public API endpoint: PUT /public/members/{id}/group-ids

Updates the specified member\'s group associations.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the member to be updated.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/public/members/{id}/group-ids';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
