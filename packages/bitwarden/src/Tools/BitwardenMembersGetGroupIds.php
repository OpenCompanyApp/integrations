<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Retrieve a member's group ids
 *
 * Maps to the official Bitwarden Public API endpoint get /public/members/{id}/group-ids.
 */
class BitwardenMembersGetGroupIds extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_get_group_ids';
    protected const DESCRIPTION = 'Retrieve a member\'s group ids

Official Bitwarden Public API endpoint: GET /public/members/{id}/group-ids

Retrieves the unique identifiers for all groups that are associated with this member. You need only supply the unique member identifier that was returned upon member creation.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the member to be retrieved.',
  ),
);
    protected const METHOD = 'GET';
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
