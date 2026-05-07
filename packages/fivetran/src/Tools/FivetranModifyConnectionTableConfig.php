<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Connection Table Config.
 *
 * Maps to the official Fivetran endpoint patch /v1/connections/{connectionId}/schemas/{schemaName}/tables/{tableName}.
 */
class FivetranModifyConnectionTableConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_connection_table_config';
    protected const DESCRIPTION = 'Update a Connection Table Config

Official Fivetran endpoint: PATCH /v1/connections/{connectionId}/schemas/{schemaName}/tables/{tableName}

Updates the table config within your database schema for an existing connection within your Fivetran account. For the NetSuite SuiteAnalytics and Salesforce and Salesforce Sandbox connectors, the \'schemas\' map field will always have a single entry with the \'netsuite\' or \'salesforce\' key, respectively.';
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
    protected const PATH = '/v1/connections/{connectionId}/schemas/{schemaName}/tables/{tableName}';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
  'schemaName' => 'schema_name',
  'tableName' => 'table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
