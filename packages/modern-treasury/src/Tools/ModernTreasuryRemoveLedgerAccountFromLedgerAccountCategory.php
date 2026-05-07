<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * remove ledger_account from ledger_account_category.
 *
 * Maps to the official Modern Treasury endpoint delete /api/ledger_account_categories/{id}/ledger_accounts/{ledger_account_id}.
 */
class ModernTreasuryRemoveLedgerAccountFromLedgerAccountCategory extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_remove_ledger_account_from_ledger_account_category';
    protected const DESCRIPTION = 'remove ledger_account from ledger_account_category

Official Modern Treasury endpoint: DELETE /api/ledger_account_categories/{id}/ledger_accounts/{ledger_account_id}

Remove a ledger account from a ledger account category.';
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
);
    protected const METHOD = 'delete';
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
