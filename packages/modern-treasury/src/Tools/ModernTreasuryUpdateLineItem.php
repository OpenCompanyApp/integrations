<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update line item.
 *
 * Maps to the official Modern Treasury endpoint patch /api/{itemizable_type}/{itemizable_id}/line_items/{id}.
 */
class ModernTreasuryUpdateLineItem extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_line_item';
    protected const DESCRIPTION = 'update line item

Official Modern Treasury endpoint: PATCH /api/{itemizable_type}/{itemizable_id}/line_items/{id}';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
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
