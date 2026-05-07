<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve a Connection Schema Config.
 *
 * Maps to the official Fivetran endpoint get /v1/connections/{connectionId}/schemas.
 */
class FivetranConnectionSchemaConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_connection_schema_config';
    protected const DESCRIPTION = 'Retrieve a Connection Schema Config

Official Fivetran endpoint: GET /v1/connections/{connectionId}/schemas

Returns the top-level schema configuration for an existing connection within your Fivetran account. The response includes global flags, every schema, each table, and only the columns that were explicitly overridden. Use this endpoint to read the current data-selection tree for a connection, or to copy the configuration to another connection. For more information, see the [Connection Schema config](https://fivetran.com/docs/rest-api/tutorials/connection-schema-configuration-use-cases) tutorial. > Note: Unedited columns (those following table defaults) are omitted from the response. For a real-time, exhaustive column list for a specific table, call the [Retrieve Source Table Columns Config](/docs/rest-api/api-reference/connection-schema/connection-column-config) endpoint. For the NetSuite SuiteAnalytics, and Salesforce and Salesforce Sandbox connectors, the \'schemas\' map field contains ...';
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
    protected const PATH = '/v1/connections/{connectionId}/schemas';
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
