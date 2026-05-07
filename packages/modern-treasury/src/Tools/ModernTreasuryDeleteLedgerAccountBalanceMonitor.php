<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete ledger_account_balance_monitor.
 *
 * Maps to the official Modern Treasury endpoint delete /api/ledger_account_balance_monitors/{id}.
 */
class ModernTreasuryDeleteLedgerAccountBalanceMonitor extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_ledger_account_balance_monitor';
    protected const DESCRIPTION = 'delete ledger_account_balance_monitor

Official Modern Treasury endpoint: DELETE /api/ledger_account_balance_monitors/{id}

Delete a ledger account balance monitor.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
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
