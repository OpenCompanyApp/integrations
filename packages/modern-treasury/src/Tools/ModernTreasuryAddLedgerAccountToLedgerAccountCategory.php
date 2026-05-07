<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * add ledger_account to ledger_account_category.
 *
 * Maps to the official Modern Treasury endpoint put /api/ledger_account_categories/{id}/ledger_accounts/{ledger_account_id}.
 */
class ModernTreasuryAddLedgerAccountToLedgerAccountCategory extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_add_ledger_account_to_ledger_account_category';
    protected const DESCRIPTION = 'add ledger_account to ledger_account_category

Official Modern Treasury endpoint: PUT /api/ledger_account_categories/{id}/ledger_accounts/{ledger_account_id}

Add a ledger account to a ledger account category.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'ledger_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ledger_account_id` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/ledger_account_categories/{id}/ledger_accounts/{ledger_account_id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
  'ledger_account_id' => 'ledger_account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
