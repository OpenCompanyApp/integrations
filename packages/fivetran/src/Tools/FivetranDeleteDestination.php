<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a Destination.
 *
 * Maps to the official Fivetran endpoint delete /v1/destinations/{destinationId}.
 */
class FivetranDeleteDestination extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_destination';
    protected const DESCRIPTION = 'Delete a Destination

Official Fivetran endpoint: DELETE /v1/destinations/{destinationId}

Deletes a destination from your Fivetran account.';
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
    protected const METHOD = 'delete';
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
