<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * patch ledger_account_settlement_entries.
 *
 * Maps to the official Modern Treasury endpoint patch /api/ledger_account_settlements/{id}/ledger_entries.
 */
class ModernTreasuryPatchLedgerAccountSettlementEntries extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_patch_ledger_account_settlement_entries';
    protected const DESCRIPTION = 'patch ledger_account_settlement_entries

Official Modern Treasury endpoint: PATCH /api/ledger_account_settlements/{id}/ledger_entries

Add ledger entries to a draft ledger account settlement.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/ledger_account_settlements/{id}/ledger_entries';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
