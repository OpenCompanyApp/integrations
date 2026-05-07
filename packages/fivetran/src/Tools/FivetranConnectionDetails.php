<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Connection Details.
 *
 * Maps to the official Fivetran endpoint get /v1/connections/{connectionId}.
 */
class FivetranConnectionDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_connection_details';
    protected const DESCRIPTION = 'Retrieve Connection Details

Official Fivetran endpoint: GET /v1/connections/{connectionId}

Returns a connection configuration and status details if a valid identifier was provided.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Fivetran API operation. The unique identifier for the connection within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/connections/{connectionId}';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
