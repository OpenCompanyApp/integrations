<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create a Connection.
 *
 * Maps to the official Fivetran endpoint post /v1/connections.
 */
class FivetranCreateConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_connection';
    protected const DESCRIPTION = 'Create a Connection

Official Fivetran endpoint: POST /v1/connections

Creates a new connection within a specified group in your Fivetran account. Runs setup tests and returns testing results. > IMPORTANT: The `destination_schema_names` field will soon become a required field. Make sure to include it in your API requests when creating new connections to prevent future disruptions.';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
