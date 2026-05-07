<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list ledger_entries.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_entries.
 */
class ModernTreasuryListLedgerEntries extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_ledger_entries';
    protected const DESCRIPTION = 'list ledger_entries

Official Modern Treasury endpoint: GET /api/ledger_entries

Get a list of all ledger entries.';
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
  'ledger_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_id` from the official Modern Treasury API operation.',
  ),
  'ledger_transaction_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_transaction_id` from the official Modern Treasury API operation.',
  ),
  'ledger_account_payout_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_payout_id` from the official Modern Treasury API operation.',
  ),
  'ledger_account_settlement_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_settlement_id` from the official Modern Treasury API operation.',
  ),
  'effective_date' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `effective_date` from the official Modern Treasury API operation.',
  ),
  'effective_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `effective_at` from the official Modern Treasury API operation.',
  ),
  'updated_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `updated_at` from the official Modern Treasury API operation.',
  ),
  'as_of_lock_version' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `as_of_lock_version` from the official Modern Treasury API operation.',
  ),
  'ledger_account_lock_version' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `ledger_account_lock_version` from the official Modern Treasury API operation.',
  ),
  'ledger_account_category_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_category_id` from the official Modern Treasury API operation.',
  ),
  'ledger_account_statement_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_statement_id` from the official Modern Treasury API operation.',
  ),
  'show_deleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `show_deleted` from the official Modern Treasury API operation.',
  ),
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `direction` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'credit',
      1 => 'debit',
    ),
  ),
  'status' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `status[]` from the official Modern Treasury API operation.',
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
  'show_balances' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `show_balances` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_entries';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'ledger_account_id' => 'ledger_account_id',
  'ledger_transaction_id' => 'ledger_transaction_id',
  'ledger_account_payout_id' => 'ledger_account_payout_id',
  'ledger_account_settlement_id' => 'ledger_account_settlement_id',
  'effective_date' => 'effective_date',
  'effective_at' => 'effective_at',
  'updated_at' => 'updated_at',
  'as_of_lock_version' => 'as_of_lock_version',
  'ledger_account_lock_version' => 'ledger_account_lock_version',
  'ledger_account_category_id' => 'ledger_account_category_id',
  'ledger_account_statement_id' => 'ledger_account_statement_id',
  'show_deleted' => 'show_deleted',
  'direction' => 'direction',
  'status' => 'status',
  'status[]' => 'status',
  'order_by' => 'order_by',
  'amount' => 'amount',
  'show_balances' => 'show_balances',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
