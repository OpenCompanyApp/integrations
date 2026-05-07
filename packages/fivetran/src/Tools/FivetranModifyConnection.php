<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Connection.
 *
 * Maps to the official Fivetran endpoint patch /v1/connections/{connectionId}.
 */
class FivetranModifyConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_connection';
    protected const DESCRIPTION = 'Update a Connection

Official Fivetran endpoint: PATCH /v1/connections/{connectionId}

Updates connection parameters for an existing connection within your Fivetran account. This endpoint requires at least one persistent configuration parameter to be specified (e.g., `sync_frequency`, `paused`, `config`, `auth`, `daily_sync_time`, `schema_status`). > IMPORTANT: Parameters like `trust_certificates`, `trust_fingerprints`, and `run_setup_tests` are test-control parameters that affect only the behavior of setup tests during the update and do not persist in the connection configuration; they cannot be used on their own. If you want to run setup tests without making configuration changes, use the POST `/v1/connections/{connectionId}/test` endpoint instead.';
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
    protected const PATH = '/v1/connections/{connectionId}';
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
