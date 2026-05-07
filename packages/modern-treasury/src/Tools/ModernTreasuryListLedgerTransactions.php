<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list ledger_transactions.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_transactions.
 */
class ModernTreasuryListLedgerTransactions extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_ledger_transactions';
    protected const DESCRIPTION = 'list ledger_transactions

Official Modern Treasury endpoint: GET /api/ledger_transactions

Get a list of ledger transactions.';
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
  'ledger_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_id` from the official Modern Treasury API operation.',
  ),
  'ledger_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_id` from the official Modern Treasury API operation.',
  ),
  'effective_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `effective_at` from the official Modern Treasury API operation.',
  ),
  'effective_date' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `effective_date` from the official Modern Treasury API operation.',
  ),
  'posted_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `posted_at` from the official Modern Treasury API operation.',
  ),
  'updated_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `updated_at` from the official Modern Treasury API operation.',
  ),
  'order_by' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `order_by` from the official Modern Treasury API operation.',
  ),
  'amount' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `amount` from the official Modern Treasury API operation.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Modern Treasury API operation.',
  ),
  'ledger_account_category_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_category_id` from the official Modern Treasury API operation.',
  ),
  'ledger_account_settlement_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_settlement_id` from the official Modern Treasury API operation.',
  ),
  'reverses_ledger_transaction_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `reverses_ledger_transaction_id` from the official Modern Treasury API operation.',
  ),
  'partially_posts_ledger_transaction_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `partially_posts_ledger_transaction_id` from the official Modern Treasury API operation.',
  ),
  'ledgerable_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledgerable_id` from the official Modern Treasury API operation.',
  ),
  'ledgerable_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledgerable_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'expected_payment',
      1 => 'incoming_payment_detail',
      2 => 'payment_order',
      3 => 'return',
      4 => 'reversal',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_transactions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'ledger_id' => 'ledger_id',
  'ledger_account_id' => 'ledger_account_id',
  'effective_at' => 'effective_at',
  'effective_date' => 'effective_date',
  'posted_at' => 'posted_at',
  'updated_at' => 'updated_at',
  'order_by' => 'order_by',
  'amount' => 'amount',
  'status' => 'status',
  'external_id' => 'external_id',
  'ledger_account_category_id' => 'ledger_account_category_id',
  'ledger_account_settlement_id' => 'ledger_account_settlement_id',
  'reverses_ledger_transaction_id' => 'reverses_ledger_transaction_id',
  'partially_posts_ledger_transaction_id' => 'partially_posts_ledger_transaction_id',
  'ledgerable_id' => 'ledgerable_id',
  'ledgerable_type' => 'ledgerable_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
