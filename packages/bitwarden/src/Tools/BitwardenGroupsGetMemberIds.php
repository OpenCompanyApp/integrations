<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Retrieve a groups's member ids
 *
 * Maps to the official Bitwarden Public API endpoint get /public/groups/{id}/member-ids.
 */
class BitwardenGroupsGetMemberIds extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_groups_get_member_ids';
    protected const DESCRIPTION = 'Retrieve a groups\'s member ids

Official Bitwarden Public API endpoint: GET /public/groups/{id}/member-ids

Retrieves the unique identifiers for all members that are associated with this group. You need only supply the unique group identifier that was returned upon group creation.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the group to be retrieved.',
  ),
);
    protected const METHOD = 'GET';
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
