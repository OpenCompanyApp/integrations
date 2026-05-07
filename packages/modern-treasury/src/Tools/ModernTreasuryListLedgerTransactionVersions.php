<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list ledger_transaction_versions.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_transaction_versions.
 */
class ModernTreasuryListLedgerTransactionVersions extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_ledger_transaction_versions';
    protected const DESCRIPTION = 'list ledger_transaction_versions

Official Modern Treasury endpoint: GET /api/ledger_transaction_versions

Get a list of ledger transaction versions.';
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
  'created_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `created_at` from the official Modern Treasury API operation.',
  ),
  'version' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `version` from the official Modern Treasury API operation.',
  ),
  'ledger_transaction_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_transaction_id` from the official Modern Treasury API operation.',
  ),
  'ledger_account_statement_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ledger_account_statement_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_transaction_versions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'created_at' => 'created_at',
  'version' => 'version',
  'ledger_transaction_id' => 'ledger_transaction_id',
  'ledger_account_statement_id' => 'ledger_account_statement_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
