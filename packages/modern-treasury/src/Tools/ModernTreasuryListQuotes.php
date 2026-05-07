<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list foreign_exchange_quotes.
 *
 * Maps to the official Modern Treasury endpoint get /api/foreign_exchange_quotes.
 */
class ModernTreasuryListQuotes extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_quotes';
    protected const DESCRIPTION = 'list foreign_exchange_quotes

Official Modern Treasury endpoint: GET /api/foreign_exchange_quotes';
    protected const PARAMETERS = array (
  'after_cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after_cursor` from the official Modern Treasury API operation.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `per_page` from the official Modern Treasury API operation.',
  ),
  'internal_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `internal_account_id` from the official Modern Treasury API operation.',
  ),
  'expires_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `expires_at` from the official Modern Treasury API operation.',
  ),
  'base_currency' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `base_currency` from the official Modern Treasury API operation.',
  ),
  'target_currency' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `target_currency` from the official Modern Treasury API operation.',
  ),
  'effective_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `effective_at_start` from the official Modern Treasury API operation.',
  ),
  'effective_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `effective_at_end` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/foreign_exchange_quotes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'internal_account_id' => 'internal_account_id',
  'expires_at' => 'expires_at',
  'base_currency' => 'base_currency',
  'target_currency' => 'target_currency',
  'effective_at_start' => 'effective_at_start',
  'effective_at_end' => 'effective_at_end',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
