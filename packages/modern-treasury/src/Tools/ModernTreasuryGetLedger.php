<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get ledger.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledgers/{id}.
 */
class ModernTreasuryGetLedger extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_ledger';
    protected const DESCRIPTION = 'get ledger

Official Modern Treasury endpoint: GET /api/ledgers/{id}

Get details on a single ledger.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
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
