<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list bulk_requests.
 *
 * Maps to the official Modern Treasury endpoint get /api/bulk_requests.
 */
class ModernTreasuryListBulkRequests extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_bulk_requests';
    protected const DESCRIPTION = 'list bulk_requests

Official Modern Treasury endpoint: GET /api/bulk_requests';
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
      1 => 'processing',
      2 => 'completed',
    ),
  ),
  'resource_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `resource_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'payment_order',
      1 => 'ledger_account',
      2 => 'ledger_transaction',
      3 => 'expected_payment',
      4 => 'transaction',
      5 => 'transaction_line_item',
      6 => 'entity_link',
    ),
  ),
  'action_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `action_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'create',
      1 => 'update',
      2 => 'delete',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/bulk_requests';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'status' => 'status',
  'resource_type' => 'resource_type',
  'action_type' => 'action_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
