<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get ledger_account_category.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_account_categories/{id}.
 */
class ModernTreasuryGetLedgerAccountCategory extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_ledger_account_category';
    protected const DESCRIPTION = 'get ledger_account_category

Official Modern Treasury endpoint: GET /api/ledger_account_categories/{id}

Get the details on a single ledger account category.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'balances' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `balances` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_account_categories/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'balances' => 'balances',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
