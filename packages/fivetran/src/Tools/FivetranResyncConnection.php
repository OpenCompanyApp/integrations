<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Re-sync Connection Data (Historical Sync).
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/resync.
 */
class FivetranResyncConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_resync_connection';
    protected const DESCRIPTION = 'Re-sync Connection Data (Historical Sync)

Official Fivetran endpoint: POST /v1/connections/{connectionId}/resync

Triggers a full historical sync of a connection or multiple schema tables within a connection. If the connection is paused, the table sync will be scheduled to be performed when the connection is re-enabled. If there is a data sync already in progress, we will try to complete it. If it fails, the request will be declined and the HTTP 409 Conflict error will be returned.';
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
    protected const PATH = '/v1/connections/{connectionId}/resync';
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
