<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Drop Blocked Columns from the Destination..
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/schemas/drop-columns.
 */
class FivetranDeleteMultipleColumnsConnectionConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_multiple_columns_connection_config';
    protected const DESCRIPTION = 'Drop Blocked Columns from the Destination.

Official Fivetran endpoint: POST /v1/connections/{connectionId}/schemas/drop-columns

Mark multiple blocked columns for deletion from your destination tables. The columns will be dropped during the next sync.';
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
    protected const PATH = '/v1/connections/{connectionId}/schemas/drop-columns';
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
