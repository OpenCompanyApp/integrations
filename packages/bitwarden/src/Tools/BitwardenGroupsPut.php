<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Update a group.
 *
 * Maps to the official Bitwarden Public API endpoint put /public/groups/{id}.
 */
class BitwardenGroupsPut extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_groups_put';
    protected const DESCRIPTION = 'Update a group.

Official Bitwarden Public API endpoint: PUT /public/groups/{id}

Updates the specified group object. If a property is not provided, the value of the existing property will be reset.';
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
    protected const PATH = '/public/groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
