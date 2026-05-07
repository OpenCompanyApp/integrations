<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get ledger_entry.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledger_entries/{id}.
 */
class ModernTreasuryGetLedgerEntry extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_ledger_entry';
    protected const DESCRIPTION = 'get ledger_entry

Official Modern Treasury endpoint: GET /api/ledger_entries/{id}

Get details on a single ledger entry.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'show_balances' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `show_balances` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledger_entries/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'show_balances' => 'show_balances',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
