<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Re-sync Connection Table Data.
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/schemas/tables/resync.
 */
class FivetranResyncTables extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_resync_tables';
    protected const DESCRIPTION = 'Re-sync Connection Table Data

Official Fivetran endpoint: POST /v1/connections/{connectionId}/schemas/tables/resync

Triggers a historical sync of all data for multiple schema tables within a connection. This action does not override the standard sync frequency you defined in the Fivetran dashboard.';
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
    protected const PATH = '/v1/connections/{connectionId}/schemas/tables/resync';
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
