<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a Group Log Service.
 *
 * Maps to the official Fivetran endpoint delete /v1/external-logging/{logId}.
 */
class FivetranDeleteLogService extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_log_service';
    protected const DESCRIPTION = 'Delete a Group Log Service

Official Fivetran endpoint: DELETE /v1/external-logging/{logId}

Deletes a group-level [logging service](/docs/logs/external-logs) from your Fivetran account.';
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
);
    protected const METHOD = 'delete';
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
