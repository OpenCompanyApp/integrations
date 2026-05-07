<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Update a Destination and fully overwrite it.
 *
 * Maps to the official Airbyte endpoint put /destinations/{destinationId}.
 */
class AirbytePutDestination extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_put_destination';
    protected const DESCRIPTION = 'Update a Destination and fully overwrite it

Official Airbyte endpoint: PUT /destinations/{destinationId}';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationId` from the official Airbyte API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'put';
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
