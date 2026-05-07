<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete ledger_account_category from ledger_account_category.
 *
 * Maps to the official Modern Treasury endpoint delete /api/ledger_account_categories/{id}/ledger_account_categories/{sub_category_id}.
 */
class ModernTreasuryDeleteLedgerAccountCategoryFromLedgerAccountCategory extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_ledger_account_category_from_ledger_account_category';
    protected const DESCRIPTION = 'delete ledger_account_category from ledger_account_category

Official Modern Treasury endpoint: DELETE /api/ledger_account_categories/{id}/ledger_account_categories/{sub_category_id}

Delete a ledger account category from a ledger account category.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'sub_category_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sub_category_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/ledger_account_categories/{id}/ledger_account_categories/{sub_category_id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
  'sub_category_id' => 'sub_category_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
