<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Create a connection.
 *
 * Maps to the official Airbyte endpoint post /connections.
 */
class AirbyteCreateConnection extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_create_connection';
    protected const DESCRIPTION = 'Create a connection

Official Airbyte endpoint: POST /connections';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
