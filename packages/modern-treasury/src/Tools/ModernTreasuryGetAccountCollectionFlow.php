<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get account_collection_flow.
 *
 * Maps to the official Modern Treasury endpoint get /api/account_collection_flows/{id}.
 */
class ModernTreasuryGetAccountCollectionFlow extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_account_collection_flow';
    protected const DESCRIPTION = 'get account_collection_flow

Official Modern Treasury endpoint: GET /api/account_collection_flows/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/account_collection_flows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
