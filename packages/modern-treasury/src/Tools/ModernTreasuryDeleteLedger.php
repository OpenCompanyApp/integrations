<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete ledger.
 *
 * Maps to the official Modern Treasury endpoint delete /api/ledgers/{id}.
 */
class ModernTreasuryDeleteLedger extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_ledger';
    protected const DESCRIPTION = 'delete ledger

Official Modern Treasury endpoint: DELETE /api/ledgers/{id}

Delete a ledger.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/ledgers/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
