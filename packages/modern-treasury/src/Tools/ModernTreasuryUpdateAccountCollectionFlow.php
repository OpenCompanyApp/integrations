<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update account_collection_flow.
 *
 * Maps to the official Modern Treasury endpoint patch /api/account_collection_flows/{id}.
 */
class ModernTreasuryUpdateAccountCollectionFlow extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_account_collection_flow';
    protected const DESCRIPTION = 'update account_collection_flow

Official Modern Treasury endpoint: PATCH /api/account_collection_flows/{id}';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
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
