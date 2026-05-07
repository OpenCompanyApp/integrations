<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update Account Log Service.
 *
 * Maps to the official Fivetran endpoint patch /v1/external-logging/account.
 */
class FivetranUpdateAccountLogService extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_update_account_log_service';
    protected const DESCRIPTION = 'Update Account Log Service

Official Fivetran endpoint: PATCH /v1/external-logging/account

Updates information for the account-level [logging service](/docs/logs/external-logs).';
    protected const PARAMETERS = array (
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
    protected const PATH = '/v1/external-logging/account';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
