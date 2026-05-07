<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Drop a Blocked Column From the Destination.
 *
 * Maps to the official Fivetran endpoint delete /v1/connections/{connectionId}/schemas/{schemaName}/tables/{tableName}/columns/{columnName}.
 */
class FivetranDeleteColumnConnectionConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_column_connection_config';
    protected const DESCRIPTION = 'Drop a Blocked Column From the Destination

Official Fivetran endpoint: DELETE /v1/connections/{connectionId}/schemas/{schemaName}/tables/{tableName}/columns/{columnName}

Marks a blocked column for deletion from your destination table. The column will be dropped during the next sync. For the NetSuite SuiteAnalytics and Salesforce and Salesforce Sandbox connectors, the \'schemas\' map field will always have a single entry with the \'netsuite\' or \'salesforce\' key, respectively.';
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
);
    protected const METHOD = 'delete';
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
