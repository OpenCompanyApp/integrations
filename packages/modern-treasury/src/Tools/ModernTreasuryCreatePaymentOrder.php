<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create payment order.
 *
 * Maps to the official Modern Treasury endpoint post /api/payment_orders.
 */
class ModernTreasuryCreatePaymentOrder extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_payment_order';
    protected const DESCRIPTION = 'create payment order

Official Modern Treasury endpoint: POST /api/payment_orders

Create a new Payment Order';
    protected const PARAMETERS = array (
  'content_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Content-Type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'application/json',
      1 => 'multipart/form-data',
    ),
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
    protected const PATH = '/api/payment_orders';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Content-Type' => 'content_type',
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
