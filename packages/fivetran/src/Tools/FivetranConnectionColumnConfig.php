<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Source Table Columns Config.
 *
 * Maps to the official Fivetran endpoint get /v1/connections/{connectionId}/schemas/{schema}/tables/{table}/columns.
 */
class FivetranConnectionColumnConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_connection_column_config';
    protected const DESCRIPTION = 'Retrieve Source Table Columns Config

Official Fivetran endpoint: GET /v1/connections/{connectionId}/schemas/{schema}/tables/{table}/columns

Returns the real-time column list for one source table by querying the source. The response includes the current enabled and hashed flags, and the patchable fields. > Note: This endpoint works only for an existing connection that is in a \'Connected\' state.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Fivetran API operation. The unique identifier for the connection within the Fivetran system.',
  ),
  'schema' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `schema` from the official Fivetran API operation. The database schema name within your destination',
  ),
  'table' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `table` from the official Fivetran API operation. The table name from the connection schema, using the original source system\'s naming conventions. This value is case-sensitive.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/connections/{connectionId}/schemas/{schema}/tables/{table}/columns';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
  'schema' => 'schema',
  'table' => 'table',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
