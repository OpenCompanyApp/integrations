<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list invoices.
 *
 * Maps to the official Modern Treasury endpoint get /api/invoices.
 */
class ModernTreasuryListInvoices extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_invoices';
    protected const DESCRIPTION = 'list invoices

Official Modern Treasury endpoint: GET /api/invoices';
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
  'counterparty_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `counterparty_id` from the official Modern Treasury API operation.',
  ),
  'originating_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `originating_account_id` from the official Modern Treasury API operation.',
  ),
  'payment_order_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `payment_order_id` from the official Modern Treasury API operation.',
  ),
  'expected_payment_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `expected_payment_id` from the official Modern Treasury API operation.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'draft',
      1 => 'paid',
      2 => 'partially_paid',
      3 => 'payment_pending',
      4 => 'unpaid',
      5 => 'voided',
    ),
  ),
  'number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `number` from the official Modern Treasury API operation.',
  ),
  'due_date_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `due_date_start` from the official Modern Treasury API operation.',
  ),
  'due_date_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `due_date_end` from the official Modern Treasury API operation.',
  ),
  'created_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_at_start` from the official Modern Treasury API operation.',
  ),
  'created_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_at_end` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/invoices';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'counterparty_id' => 'counterparty_id',
  'originating_account_id' => 'originating_account_id',
  'payment_order_id' => 'payment_order_id',
  'expected_payment_id' => 'expected_payment_id',
  'status' => 'status',
  'number' => 'number',
  'due_date_start' => 'due_date_start',
  'due_date_end' => 'due_date_end',
  'created_at_start' => 'created_at_start',
  'created_at_end' => 'created_at_end',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
