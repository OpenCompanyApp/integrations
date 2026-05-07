<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Update a member.
 *
 * Maps to the official Bitwarden Public API endpoint put /public/members/{id}.
 */
class BitwardenMembersPut extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_members_put';
    protected const DESCRIPTION = 'Update a member.

Official Bitwarden Public API endpoint: PUT /public/members/{id}

Updates the specified member object. If a property is not provided, the value of the existing property will be reset.';
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
