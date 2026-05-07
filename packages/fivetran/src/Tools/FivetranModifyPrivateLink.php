<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Private Link.
 *
 * Maps to the official Fivetran endpoint patch /v1/private-links/{privateLinkId}.
 */
class FivetranModifyPrivateLink extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_private_link';
    protected const DESCRIPTION = 'Update a Private Link

Official Fivetran endpoint: PATCH /v1/private-links/{privateLinkId}

Updates information for an existing private link within your Fivetran account.';
    protected const PARAMETERS = array (
  'private_link_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `privateLinkId` from the official Fivetran API operation. The unique identifier for the private link within the Fivetran system',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/private-links/{privateLinkId}';
    protected const PATH_PARAMS = array (
  'privateLinkId' => 'private_link_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
