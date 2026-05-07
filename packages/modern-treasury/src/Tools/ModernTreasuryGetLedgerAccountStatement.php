<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get ledger_account_statement.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_account_statements/{id}.
 */
class ModernTreasuryGetLedgerAccountStatement extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_ledger_account_statement';
    protected const DESCRIPTION = 'get ledger_account_statement

Official Modern Treasury endpoint: GET /api/ledger_account_statements/{id}

Get details on a single ledger account statement.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_account_statements/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
