<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Delete a Destination.
 *
 * Maps to the official Airbyte endpoint delete /destinations/{destinationId}.
 */
class AirbyteDeleteDestination extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_delete_destination';
    protected const DESCRIPTION = 'Delete a Destination

Official Airbyte endpoint: DELETE /destinations/{destinationId}';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/destinations/{destinationId}';
    protected const PATH_PARAMS = array (
  'destinationId' => 'destination_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
