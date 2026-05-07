<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * add payment_order_id to invoice.
 *
 * Maps to the official Modern Treasury endpoint put /api/invoices/{id}/payment_orders/{payment_order_id}.
 */
class ModernTreasuryAddPaymentOrderToInvoice extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_add_payment_order_to_invoice';
    protected const DESCRIPTION = 'add payment_order_id to invoice

Official Modern Treasury endpoint: PUT /api/invoices/{id}/payment_orders/{payment_order_id}

Add a payment order to an invoice.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'payment_order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `payment_order_id` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/invoices/{id}/payment_orders/{payment_order_id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
  'payment_order_id' => 'payment_order_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
