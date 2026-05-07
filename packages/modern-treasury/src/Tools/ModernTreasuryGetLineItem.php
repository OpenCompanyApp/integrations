<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get line item.
 *
 * Maps to the official Modern Treasury endpoint get /api/{itemizable_type}/{itemizable_id}/line_items/{id}.
 */
class ModernTreasuryGetLineItem extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_line_item';
    protected const DESCRIPTION = 'get line item

Official Modern Treasury endpoint: GET /api/{itemizable_type}/{itemizable_id}/line_items/{id}

Get a single line item';
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
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/{itemizable_type}/{itemizable_id}/line_items/{id}';
    protected const PATH_PARAMS = array (
  'itemizable_type' => 'itemizable_type',
  'itemizable_id' => 'itemizable_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
