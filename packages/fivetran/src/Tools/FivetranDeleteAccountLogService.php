<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete Account Log Service.
 *
 * Maps to the official Fivetran endpoint delete /v1/external-logging/account.
 */
class FivetranDeleteAccountLogService extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_account_log_service';
    protected const DESCRIPTION = 'Delete Account Log Service

Official Fivetran endpoint: DELETE /v1/external-logging/account

Deletes the account-level [logging service](/docs/logs/external-logs).';
    protected const PARAMETERS = array (
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'delete';
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
