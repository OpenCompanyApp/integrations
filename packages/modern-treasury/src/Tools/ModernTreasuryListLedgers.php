<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list ledgers.
 *
 * Maps to the official Modern Treasury endpoint get /api/ledgers.
 */
class ModernTreasuryListLedgers extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_ledgers';
    protected const DESCRIPTION = 'list ledgers

Official Modern Treasury endpoint: GET /api/ledgers

Get a list of ledgers.';
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
  'updated_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `updated_at` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/ledgers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'updated_at' => 'updated_at',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
