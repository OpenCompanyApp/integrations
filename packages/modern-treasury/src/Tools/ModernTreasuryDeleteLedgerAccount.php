<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete ledger_account.
 *
 * Maps to the official Modern Treasury endpoint delete /api/ledger_accounts/{id}.
 */
class ModernTreasuryDeleteLedgerAccount extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_ledger_account';
    protected const DESCRIPTION = 'delete ledger_account

Official Modern Treasury endpoint: DELETE /api/ledger_accounts/{id}

Delete a ledger account.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/ledger_accounts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
