<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get foreign_exchange_quote.
 *
 * Maps to the official Modern Treasury endpoint get /api/foreign_exchange_quotes/{id}.
 */
class ModernTreasuryGetQuote extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_quote';
    protected const DESCRIPTION = 'get foreign_exchange_quote

Official Modern Treasury endpoint: GET /api/foreign_exchange_quotes/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/foreign_exchange_quotes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
