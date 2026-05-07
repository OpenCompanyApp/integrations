<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Get stream properties.
 *
 * Maps to the official Airbyte endpoint get /streams.
 */
class AirbyteGetStreamProperties extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_get_stream_properties';
    protected const DESCRIPTION = 'Get stream properties

Official Airbyte endpoint: GET /streams';
    protected const PARAMETERS = array (
  'source_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `sourceId` from the official Airbyte API operation. ID of the source',
  ),
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `destinationId` from the official Airbyte API operation. ID of the destination',
  ),
  'ignore_cache' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `ignoreCache` from the official Airbyte API operation. If true pull the latest schema from the source, else pull from cache (default false)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/streams';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'sourceId' => 'source_id',
  'destinationId' => 'destination_id',
  'ignoreCache' => 'ignore_cache',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
