<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get ledger_transaction.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_transactions/{id}.
 */
class ModernTreasuryGetLedgerTransaction extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_ledger_transaction';
    protected const DESCRIPTION = 'get ledger_transaction

Official Modern Treasury endpoint: GET /api/ledger_transactions/{id}

Get details on a single ledger transaction.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_transactions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
