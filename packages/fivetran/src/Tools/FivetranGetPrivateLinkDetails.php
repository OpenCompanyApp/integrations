<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Private Link Details.
 *
 * Maps to the official Fivetran endpoint get /v1/private-links/{privateLinkId}.
 */
class FivetranGetPrivateLinkDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_private_link_details';
    protected const DESCRIPTION = 'Retrieve Private Link Details

Official Fivetran endpoint: GET /v1/private-links/{privateLinkId}

Returns a private link object if a valid identifier was provided.';
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
);
    protected const METHOD = 'get';
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
