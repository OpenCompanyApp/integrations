<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Connection Column Config.
 *
 * Maps to the official Fivetran endpoint patch /v1/connections/{connectionId}/schemas/{schemaName}/tables/{tableName}/columns/{columnName}.
 */
class FivetranModifyConnectionColumnConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_connection_column_config';
    protected const DESCRIPTION = 'Update a Connection Column Config

Official Fivetran endpoint: PATCH /v1/connections/{connectionId}/schemas/{schemaName}/tables/{tableName}/columns/{columnName}

Updates the column config within your table for an existing connection within your Fivetran account. For the NetSuite SuiteAnalytics and Salesforce and Salesforce Sandbox connectors, the \'schemas\' map field will always have a single entry with the \'netsuite\' or \'salesforce\' key, respectively. > NOTE: The response contains all known schemas and tables. Also, it contains columns whose state has ever been set by the user. For more information, see also the [Connection Schema config](https://fivetran.com/docs/rest-api/tutorials/connection-schema-configuration-use-cases) tutorial.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Fivetran API operation. The unique identifier for the connection within the Fivetran system.',
  ),
  'schema_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `schemaName` from the official Fivetran API operation. The schema name as stored in the connection schema config. This value is case-sensitive; an incorrect case results in an HTTP 404 error.',
  ),
  'table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tableName` from the official Fivetran API operation. The table name as stored in the connection schema config. This value is case-sensitive; an incorrect case results in an HTTP 404 error.',
  ),
  'column_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `columnName` from the official Fivetran API operation. The column name as stored in the connection schema config. This value is case-sensitive; an incorrect case results in an HTTP 404 error.',
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
    protected const PATH = '/v1/connections/{connectionId}/schemas/{schemaName}/tables/{tableName}/columns/{columnName}';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
  'schemaName' => 'schema_name',
  'tableName' => 'table_name',
  'columnName' => 'column_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
