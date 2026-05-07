<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Get Account Info from the API Key.
 *
 * Maps to the official Fivetran endpoint get /v1/account/info.
 */
class FivetranGetAccountInfo extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_account_info';
    protected const DESCRIPTION = 'Get Account Info from the API Key

Official Fivetran endpoint: GET /v1/account/info

Returns information about current account from API key.';
    protected const PARAMETERS = array (
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/account/info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
