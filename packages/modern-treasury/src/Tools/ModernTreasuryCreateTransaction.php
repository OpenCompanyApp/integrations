<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create transaction.
 *
 * Maps to the official Modern Treasury endpoint post /api/transactions.
 */
class ModernTreasuryCreateTransaction extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_transaction';
    protected const DESCRIPTION = 'create transaction

Official Modern Treasury endpoint: POST /api/transactions';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'post';
    protected const PATH = '/api/transactions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
