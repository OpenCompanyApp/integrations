<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Destination.
 *
 * Maps to the official Fivetran endpoint patch /v1/destinations/{destinationId}.
 */
class FivetranModifyDestination extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_destination';
    protected const DESCRIPTION = 'Update a Destination

Official Fivetran endpoint: PATCH /v1/destinations/{destinationId}

Updates information for an existing destination within your Fivetran account.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
