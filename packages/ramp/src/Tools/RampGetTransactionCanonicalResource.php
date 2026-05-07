<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a transaction.
 *
 * Maps to the official Ramp endpoint get /developer/v1/transactions/{transaction_id}.
 */
class RampGetTransactionCanonicalResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_transaction_canonical_resource';
    protected const DESCRIPTION = 'Fetch a transaction

Official Ramp endpoint: GET /developer/v1/transactions/{transaction_id}';
    protected const PARAMETERS = array (
  'transaction_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `transaction_id` from the official Ramp API operation.',
  ),
  'include_merchant_data' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_merchant_data` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/transactions/{transaction_id}';
    protected const PATH_PARAMS = array (
  'transaction_id' => 'transaction_id',
);
    protected const QUERY_PARAMS = array (
  'include_merchant_data' => 'include_merchant_data',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
