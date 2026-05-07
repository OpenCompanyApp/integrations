<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create reversal.
 *
 * Maps to the official Modern Treasury endpoint post /api/payment_orders/{payment_order_id}/reversals.
 */
class ModernTreasuryCreateReversal extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_reversal';
    protected const DESCRIPTION = 'create reversal

Official Modern Treasury endpoint: POST /api/payment_orders/{payment_order_id}/reversals

Create a reversal for a payment order.';
    protected const PARAMETERS = array (
  'payment_order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `payment_order_id` from the official Modern Treasury API operation.',
  ),
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
    protected const PATH = '/api/payment_orders/{payment_order_id}/reversals';
    protected const PATH_PARAMS = array (
  'payment_order_id' => 'payment_order_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
