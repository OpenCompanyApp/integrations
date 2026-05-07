<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list transaction_line_items.
 *
 * Maps to the official Modern Treasury endpoint get /api/transaction_line_items.
 */
class ModernTreasuryListTransactionLineItems extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_transaction_line_items';
    protected const DESCRIPTION = 'list transaction_line_items

Official Modern Treasury endpoint: GET /api/transaction_line_items';
    protected const PARAMETERS = array (
  'after_cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after_cursor` from the official Modern Treasury API operation.',
  ),
  'id' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `id` from the official Modern Treasury API operation.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'originating',
      1 => 'receiving',
    ),
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `per_page` from the official Modern Treasury API operation.',
  ),
  'transaction_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `transaction_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/transaction_line_items';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'id' => 'id',
  'type' => 'type',
  'per_page' => 'per_page',
  'transaction_id' => 'transaction_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
