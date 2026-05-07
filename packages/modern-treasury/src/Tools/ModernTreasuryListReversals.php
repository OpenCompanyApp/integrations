<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list reversals.
 *
 * Maps to the official Modern Treasury endpoint get /api/payment_orders/{payment_order_id}/reversals.
 */
class ModernTreasuryListReversals extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_reversals';
    protected const DESCRIPTION = 'list reversals

Official Modern Treasury endpoint: GET /api/payment_orders/{payment_order_id}/reversals

Get a list of all reversals of a payment order.';
    protected const PARAMETERS = array (
  'payment_order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `payment_order_id` from the official Modern Treasury API operation.',
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
    protected const PATH = '/api/payment_orders/{payment_order_id}/reversals';
    protected const PATH_PARAMS = array (
  'payment_order_id' => 'payment_order_id',
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
