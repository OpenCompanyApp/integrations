<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List bank accounts.
 *
 * Maps to the official Ramp endpoint get /developer/v1/bank-accounts.
 */
class RampGetBankAccountListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_bank_account_list_with_pagination';
    protected const DESCRIPTION = 'List bank accounts

Official Ramp endpoint: GET /developer/v1/bank-accounts';
    protected const PARAMETERS = array (
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/bank-accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
