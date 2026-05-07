<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create foreign_exchange_quote.
 *
 * Maps to the official Modern Treasury endpoint post /api/foreign_exchange_quotes.
 */
class ModernTreasuryCreateQuote extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_quote';
    protected const DESCRIPTION = 'create foreign_exchange_quote

Official Modern Treasury endpoint: POST /api/foreign_exchange_quotes';
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
    protected const PATH = '/api/foreign_exchange_quotes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
