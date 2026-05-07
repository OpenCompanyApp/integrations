<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create Account Log Service.
 *
 * Maps to the official Fivetran endpoint post /v1/external-logging/account.
 */
class FivetranAddAccountLogService extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_add_account_log_service';
    protected const DESCRIPTION = 'Create Account Log Service

Official Fivetran endpoint: POST /v1/external-logging/account

Creates an account-level [logging service](/docs/logs/external-logs).';
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
    protected const METHOD = 'post';
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
