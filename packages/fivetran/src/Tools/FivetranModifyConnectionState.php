<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Connection State.
 *
 * Maps to the official Fivetran endpoint patch /v1/connections/{connectionId}/state.
 */
class FivetranModifyConnectionState extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_connection_state';
    protected const DESCRIPTION = 'Update a Connection State

Official Fivetran endpoint: PATCH /v1/connections/{connectionId}/state

Updates the connection state. To update the state, you should pause your connection first. To update the connection state, do the following: 1. Pause connection using [Update a Connection](https://fivetran.com/docs/rest-api/api-reference/connections/modify-connection) endpoint (set \'paused\' to \'true\'). 2. Update the state by using the [Update Connection State](https://fivetran.com/docs/rest-api/api-reference/connections/modify-connection-state) endpoint. 3. Unpause the connection by setting the \'paused\' parameter to \'false\' in the [Update a Connection](https://fivetran.com/docs/rest-api/api-reference/connections/modify-connection) endpoint request. This endpoint is only supported for [Function](https://fivetran.com/docs/connectors/functions) and [Connection SDK](https://fivetran.com/docs/connectors/connector-sdk) connectors.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
