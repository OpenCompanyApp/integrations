<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Get Destination details.
 *
 * Maps to the official Airbyte endpoint get /destinations/{destinationId}.
 */
class AirbyteGetDestination extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_get_destination';
    protected const DESCRIPTION = 'Get Destination details

Official Airbyte endpoint: GET /destinations/{destinationId}';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'get';
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
