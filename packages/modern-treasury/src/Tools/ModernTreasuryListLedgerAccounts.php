<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list ledger_accounts.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_accounts.
 */
class ModernTreasuryListLedgerAccounts extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_ledger_accounts';
    protected const DESCRIPTION = 'list ledger_accounts

Official Modern Treasury endpoint: GET /api/ledger_accounts

Get a list of ledger accounts.';
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
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Modern Treasury API operation.',
  ),
  'currency' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `currency` from the official Modern Treasury API operation.',
  ),
  'balances' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `balances` from the official Modern Treasury API operation.',
  ),
  'pending_balance_amount' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `pending_balance_amount` from the official Modern Treasury API operation.',
  ),
  'posted_balance_amount' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `posted_balance_amount` from the official Modern Treasury API operation.',
  ),
  'available_balance_amount' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `available_balance_amount` from the official Modern Treasury API operation.',
  ),
  'normal_balance' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `normal_balance` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'credit',
      1 => 'debit',
    ),
  ),
  'created_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `created_at` from the official Modern Treasury API operation.',
  ),
  'updated_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `updated_at` from the official Modern Treasury API operation.',
  ),
  'ledger_account_category_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_category_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'ledger_id' => 'ledger_id',
  'external_id' => 'external_id',
  'currency' => 'currency',
  'balances' => 'balances',
  'pending_balance_amount' => 'pending_balance_amount',
  'posted_balance_amount' => 'posted_balance_amount',
  'available_balance_amount' => 'available_balance_amount',
  'normal_balance' => 'normal_balance',
  'created_at' => 'created_at',
  'updated_at' => 'updated_at',
  'ledger_account_category_id' => 'ledger_account_category_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
