<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update payment order.
 *
 * Maps to the official Modern Treasury endpoint patch /api/payment_orders/{id}.
 */
class ModernTreasuryUpdatePaymentOrder extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_payment_order';
    protected const DESCRIPTION = 'update payment order

Official Modern Treasury endpoint: PATCH /api/payment_orders/{id}

Update a payment order';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/payment_orders/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
