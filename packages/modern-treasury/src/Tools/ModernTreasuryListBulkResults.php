<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list bulk_results.
 *
 * Maps to the official Modern Treasury endpoint get /api/bulk_results.
 */
class ModernTreasuryListBulkResults extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_bulk_results';
    protected const DESCRIPTION = 'list bulk_results

Official Modern Treasury endpoint: GET /api/bulk_results';
    protected const PARAMETERS = array (
  'after_cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after_cursor` from the official Modern Treasury API operation.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `per_page` from the official Modern Treasury API operation.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'pending',
      1 => 'successful',
      2 => 'failed',
    ),
  ),
  'request_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `request_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'bulk_request',
    ),
  ),
  'request_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `request_id` from the official Modern Treasury API operation.',
  ),
  'entity_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'payment_order',
      1 => 'ledger_account',
      2 => 'ledger_transaction',
      3 => 'expected_payment',
      4 => 'transaction',
      5 => 'entity_link',
      6 => 'transaction_line_item',
      7 => 'bulk_error',
    ),
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/bulk_results';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'status' => 'status',
  'request_type' => 'request_type',
  'request_id' => 'request_id',
  'entity_type' => 'entity_type',
  'entity_id' => 'entity_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
