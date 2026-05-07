<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Connection Database Schema Config.
 *
 * Maps to the official Fivetran endpoint patch /v1/connections/{connectionId}/schemas/{schemaName}.
 */
class FivetranModifyConnectionDatabaseSchemaConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_connection_database_schema_config';
    protected const DESCRIPTION = 'Update a Connection Database Schema Config

Official Fivetran endpoint: PATCH /v1/connections/{connectionId}/schemas/{schemaName}

Updates the database schema config for an existing connection within your Fivetran account (for a single schema within a connection with multiple schemas). > NOTE: The response contains all known schemas and tables. Also, it contains columns whose state has ever been set by the user. For more information, see also the [Connection Schema config](https://fivetran.com/docs/rest-api/tutorials/connection-schema-configuration-use-cases) tutorial. In this API call, the NetSuite SuiteAnalytics, Salesforce and Salesforce Sandbox connectors always return the schema name as \'netsuite\' and \'salesforce\', respectively. For more information about this API call for the Oracle Fusion Cloud Applications connectors, see our [Schema information](https://fivetran.com/docs/connectors/applications/oracle-fusion-cloud-applications#schemainformation) documentation.';
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
    protected const PATH = '/v1/connections/{connectionId}/schemas/{schemaName}';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
  'schemaName' => 'schema_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
