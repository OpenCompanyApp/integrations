<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Reload a Connection Schema Config.
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/schemas/reload.
 */
class FivetranReloadConnectionSchemaConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_reload_connection_schema_config';
    protected const DESCRIPTION = 'Reload a Connection Schema Config

Official Fivetran endpoint: POST /v1/connections/{connectionId}/schemas/reload

Reloads the connection schema config for an existing connection within your Fivetran account. > NOTE: This method reloads the full schema from the connection\'s data source. It may take a long time to complete the request. The method execution speed depends on the schema size and the number of databases, tables, and columns. > > The response contains all known schemas and tables. Also, it contains columns whose state has ever been set by the user. For more information, see also the [Connection Schema config](https://fivetran.com/docs/rest-api/tutorials/connection-schema-configuration-use-cases) tutorial.';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/connections/{connectionId}/schemas/reload';
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
