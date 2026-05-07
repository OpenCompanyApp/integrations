<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List repayments.
 *
 * Maps to the official Ramp endpoint get /developer/v1/repayments.
 */
class RampGetRepaymentListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_repayment_list_with_pagination';
    protected const DESCRIPTION = 'List repayments

Official Ramp endpoint: GET /developer/v1/repayments

This endpoint supports filtering. Results are sorted by creation date in descending order. Note that entity_id filtering is not supported yet.';
    protected const PARAMETERS = array (
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
  ),
  'funding_methods' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `funding_methods` from the official Ramp API operation.',
  ),
  'from_repaid_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_repaid_at` from the official Ramp API operation.',
  ),
  'to_repaid_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_repaid_at` from the official Ramp API operation.',
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
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/repayments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'entity_id' => 'entity_id',
  'funding_methods' => 'funding_methods',
  'from_repaid_at' => 'from_repaid_at',
  'to_repaid_at' => 'to_repaid_at',
  'start' => 'start',
  'page_size' => 'page_size',
  'user_id' => 'user_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
