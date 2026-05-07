<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Connection Schema Config.
 *
 * Maps to the official Fivetran endpoint patch /v1/connections/{connectionId}/schemas.
 */
class FivetranModifyConnectionSchemaConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_connection_schema_config';
    protected const DESCRIPTION = 'Update a Connection Schema Config

Official Fivetran endpoint: PATCH /v1/connections/{connectionId}/schemas

Updates the schema config for an existing connection within your Fivetran account. > NOTE: For backward compatibility, the response may contain the \'enable_new_by_default\' boolean field. It defines whether new schemas and tables discovered in the source are synced. The value is \'true\' if you specify \'ALLOW_ALL\' as a value of \'schema_change_handling\'. In the future API versions, we may remove this field. > > The response contains all known schemas and tables. Also, it contains columns whose state has ever been set by the user. For more information, see also the [Connection Schema config](https://fivetran.com/docs/rest-api/tutorials/connection-schema-configuration-use-cases) tutorial.';
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
