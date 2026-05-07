<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Connection State.
 *
 * Maps to the official Fivetran endpoint get /v1/connections/{connectionId}/state.
 */
class FivetranConnectionState extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_connection_state';
    protected const DESCRIPTION = 'Retrieve Connection State

Official Fivetran endpoint: GET /v1/connections/{connectionId}/state

Returns the connection state. This endpoint is only supported for Function and Connection SDK connectors.';
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
    protected const PATH = '/v1/connections/{connectionId}/state';
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
