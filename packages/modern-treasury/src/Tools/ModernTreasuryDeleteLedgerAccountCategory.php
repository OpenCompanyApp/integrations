<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete ledger_account_category.
 *
 * Maps to the official Modern Treasury endpoint delete /api/ledger_account_categories/{id}.
 */
class ModernTreasuryDeleteLedgerAccountCategory extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_ledger_account_category';
    protected const DESCRIPTION = 'delete ledger_account_category

Official Modern Treasury endpoint: DELETE /api/ledger_account_categories/{id}

Delete a ledger account category.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/ledger_account_categories/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
