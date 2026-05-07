<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Destination Details.
 *
 * Maps to the official Fivetran endpoint get /v1/destinations/{destinationId}.
 */
class FivetranDestinationDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_destination_details';
    protected const DESCRIPTION = 'Retrieve Destination Details

Official Fivetran endpoint: GET /v1/destinations/{destinationId}

Returns a destination object if a valid identifier was provided.';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationId` from the official Fivetran API operation. The unique identifier for the destination within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/destinations/{destinationId}';
    protected const PATH_PARAMS = array (
  'destinationId' => 'destination_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
