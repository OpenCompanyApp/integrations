<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update ledger_transaction.
 *
 * Maps to the official Modern Treasury endpoint patch /api/ledger_transactions/{id}.
 */
class ModernTreasuryUpdateLedgerTransaction extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_ledger_transaction';
    protected const DESCRIPTION = 'update ledger_transaction

Official Modern Treasury endpoint: PATCH /api/ledger_transactions/{id}

Update the details of a ledger transaction.';
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
