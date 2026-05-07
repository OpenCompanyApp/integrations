<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Sync Connection Data.
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/sync.
 */
class FivetranSyncConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_sync_connection';
    protected const DESCRIPTION = 'Sync Connection Data

Official Fivetran endpoint: POST /v1/connections/{connectionId}/sync

Triggers a data sync for an existing connection within your Fivetran account without waiting for the next scheduled sync. This action does not override the standard sync frequency you defined in the Fivetran dashboard.';
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
    protected const PATH = '/v1/connections/{connectionId}/sync';
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
