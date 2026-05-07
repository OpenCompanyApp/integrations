<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list ledger_account_balance_monitors.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_account_balance_monitors.
 */
class ModernTreasuryListLedgerAccountBalanceMonitors extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_ledger_account_balance_monitors';
    protected const DESCRIPTION = 'list ledger_account_balance_monitors

Official Modern Treasury endpoint: GET /api/ledger_account_balance_monitors

Get a list of ledger account balance monitors.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_account_balance_monitors';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'ledger_account_id' => 'ledger_account_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
