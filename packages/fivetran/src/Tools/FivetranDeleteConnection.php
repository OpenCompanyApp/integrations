<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a Connection.
 *
 * Maps to the official Fivetran endpoint delete /v1/connections/{connectionId}.
 */
class FivetranDeleteConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_connection';
    protected const DESCRIPTION = 'Delete a Connection

Official Fivetran endpoint: DELETE /v1/connections/{connectionId}

Deletes a connection from your Fivetran account.';
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
    protected const METHOD = 'delete';
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
