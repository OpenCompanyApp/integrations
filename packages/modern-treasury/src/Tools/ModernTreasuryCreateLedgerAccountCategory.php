<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create ledger_account_category.
 *
 * Maps to the official Modern Treasury endpoint post /api/ledger_account_categories.
 */
class ModernTreasuryCreateLedgerAccountCategory extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_ledger_account_category';
    protected const DESCRIPTION = 'create ledger_account_category

Official Modern Treasury endpoint: POST /api/ledger_account_categories

Create a ledger account category.';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/ledger_account_categories';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
