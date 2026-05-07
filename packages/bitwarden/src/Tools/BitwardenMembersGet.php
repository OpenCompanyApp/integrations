<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Retrieve a member.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/members/{id}.
 */
class BitwardenMembersGet extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_get';
    protected const DESCRIPTION = 'Retrieve a member.

Official Bitwarden Public API endpoint: GET /public/members/{id}

Retrieves the details of an existing member of the organization. You need only supply the unique member identifier that was returned upon member creation.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the member to be retrieved.',
  ),
);
    protected const METHOD = 'GET';
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
