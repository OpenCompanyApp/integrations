<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Group Log Service.
 *
 * Maps to the official Fivetran endpoint patch /v1/external-logging/{logId}.
 */
class FivetranUpdateLogService extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_update_log_service';
    protected const DESCRIPTION = 'Update a Group Log Service

Official Fivetran endpoint: PATCH /v1/external-logging/{logId}

Updates information for an existing group-level [logging service](/docs/logs/external-logs) within your Fivetran account.';
    protected const PARAMETERS = array (
  'log_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `logId` from the official Fivetran API operation. The unique identifier for the log service within the Fivetran system.',
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
    protected const PATH = '/v1/external-logging/{logId}';
    protected const PATH_PARAMS = array (
  'logId' => 'log_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
