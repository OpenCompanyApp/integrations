<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Account Log Service.
 *
 * Maps to the official Fivetran endpoint get /v1/external-logging/account.
 */
class FivetranGetAccountLogServiceDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_account_log_service_details';
    protected const DESCRIPTION = 'Retrieve Account Log Service

Official Fivetran endpoint: GET /v1/external-logging/account

Returns the account-level [logging service](/docs/logs/external-logs) if it exists.';
    protected const PARAMETERS = array (
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
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
