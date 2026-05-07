<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list line items.
 *
 * Maps to the official Modern Treasury endpoint get /api/{itemizable_type}/{itemizable_id}/line_items.
 */
class ModernTreasuryListLineItems extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_line_items';
    protected const DESCRIPTION = 'list line items

Official Modern Treasury endpoint: GET /api/{itemizable_type}/{itemizable_id}/line_items

Get a list of line items';
    protected const PARAMETERS = array (
  'itemizable_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `itemizable_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'expected_payments',
      1 => 'payment_orders',
    ),
  ),
  'itemizable_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `itemizable_id` from the official Modern Treasury API operation.',
  ),
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/{itemizable_type}/{itemizable_id}/line_items';
    protected const PATH_PARAMS = array (
  'itemizable_type' => 'itemizable_type',
  'itemizable_id' => 'itemizable_id',
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
