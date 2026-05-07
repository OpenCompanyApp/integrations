<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Get Connection details.
 *
 * Maps to the official Airbyte endpoint get /connections/{connectionId}.
 */
class AirbyteGetConnection extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_get_connection';
    protected const DESCRIPTION = 'Get Connection details

Official Airbyte endpoint: GET /connections/{connectionId}';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/connections/{connectionId}';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
