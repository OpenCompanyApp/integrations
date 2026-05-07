<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Update a group's members.
 *
 * Maps to the official Bitwarden Public API endpoint put /public/groups/{id}/member-ids.
 */
class BitwardenGroupsPutMemberIds extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_groups_put_member_ids';
    protected const DESCRIPTION = 'Update a group\'s members.

Official Bitwarden Public API endpoint: PUT /public/groups/{id}/member-ids

Updates the specified group\'s member associations.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the group to be updated.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/public/groups/{id}/member-ids';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
