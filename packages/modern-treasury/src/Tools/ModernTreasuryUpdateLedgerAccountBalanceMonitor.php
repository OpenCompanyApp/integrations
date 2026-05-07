<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update ledger_account_balance_monitor.
 *
 * Maps to the official Modern Treasury endpoint patch /api/ledger_account_balance_monitors/{id}.
 */
class ModernTreasuryUpdateLedgerAccountBalanceMonitor extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_ledger_account_balance_monitor';
    protected const DESCRIPTION = 'update ledger_account_balance_monitor

Official Modern Treasury endpoint: PATCH /api/ledger_account_balance_monitors/{id}

Update a ledger account balance monitor.';
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
    protected const PATH = '/api/ledger_account_balance_monitors/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
