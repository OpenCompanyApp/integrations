<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get transaction.
 *
 * Maps to the official Modern Treasury endpoint get /api/transactions/{id}.
 */
class ModernTreasuryGetTransaction extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_transaction';
    protected const DESCRIPTION = 'get transaction

Official Modern Treasury endpoint: GET /api/transactions/{id}

Get details on a single transaction.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/transactions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
