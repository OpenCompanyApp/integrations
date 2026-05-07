<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list ledger_account_categories.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_account_categories.
 */
class ModernTreasuryListLedgerAccountCategories extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_ledger_account_categories';
    protected const DESCRIPTION = 'list ledger_account_categories

Official Modern Treasury endpoint: GET /api/ledger_account_categories

Get a list of ledger account categories.';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Modern Treasury API operation.',
  ),
  'ledger_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_id` from the official Modern Treasury API operation.',
  ),
  'currency' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `currency` from the official Modern Treasury API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Modern Treasury API operation.',
  ),
  'parent_ledger_account_category_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `parent_ledger_account_category_id` from the official Modern Treasury API operation.',
  ),
  'ledger_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_id` from the official Modern Treasury API operation.',
  ),
  'balances' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `balances` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_account_categories';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'name' => 'name',
  'ledger_id' => 'ledger_id',
  'currency' => 'currency',
  'external_id' => 'external_id',
  'parent_ledger_account_category_id' => 'parent_ledger_account_category_id',
  'ledger_account_id' => 'ledger_account_id',
  'balances' => 'balances',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
