<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list ledger_account_settlements.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_account_settlements.
 */
class ModernTreasuryListLedgerAccountSettlements extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_ledger_account_settlements';
    protected const DESCRIPTION = 'list ledger_account_settlements

Official Modern Treasury endpoint: GET /api/ledger_account_settlements

Get a list of ledger account settlements.';
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
  'settled_ledger_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `settled_ledger_account_id` from the official Modern Treasury API operation.',
  ),
  'settlement_entry_direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `settlement_entry_direction` from the official Modern Treasury API operation.',
  ),
  'ledger_transaction_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_transaction_id` from the official Modern Treasury API operation.',
  ),
  'ledger_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_id` from the official Modern Treasury API operation.',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_account_settlements';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'settled_ledger_account_id' => 'settled_ledger_account_id',
  'settlement_entry_direction' => 'settlement_entry_direction',
  'ledger_transaction_id' => 'ledger_transaction_id',
  'ledger_id' => 'ledger_id',
  'created_at' => 'created_at',
  'updated_at' => 'updated_at',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
