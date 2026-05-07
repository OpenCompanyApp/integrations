<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Get bank account details.
 *
 * Maps to the official Ramp endpoint get /developer/v1/bank-accounts/{bank_account_id}.
 */
class RampGetBankAccountResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_bank_account_resource';
    protected const DESCRIPTION = 'Get bank account details

Official Ramp endpoint: GET /developer/v1/bank-accounts/{bank_account_id}';
    protected const PARAMETERS = array (
  'bank_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bank_account_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/bank-accounts/{bank_account_id}';
    protected const PATH_PARAMS = array (
  'bank_account_id' => 'bank_account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
