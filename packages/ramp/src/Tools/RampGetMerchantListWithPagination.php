<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List merchants.
 *
 * Maps to the official Ramp endpoint get /developer/v1/merchants.
 */
class RampGetMerchantListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_merchant_list_with_pagination';
    protected const DESCRIPTION = 'List merchants

Official Ramp endpoint: GET /developer/v1/merchants';
    protected const PARAMETERS = array (
  'transaction_from_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `transaction_from_date` from the official Ramp API operation.',
  ),
  'transaction_to_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `transaction_to_date` from the official Ramp API operation.',
  ),
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
    protected const PATH = '/developer/v1/merchants';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'transaction_from_date' => 'transaction_from_date',
  'transaction_to_date' => 'transaction_to_date',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
