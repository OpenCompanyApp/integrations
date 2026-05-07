<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * show reversal.
 *
 * Maps to the official Modern Treasury endpoint get /api/payment_orders/{payment_order_id}/reversals/{reversal_id}.
 */
class ModernTreasuryGetReversal extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_reversal';
    protected const DESCRIPTION = 'show reversal

Official Modern Treasury endpoint: GET /api/payment_orders/{payment_order_id}/reversals/{reversal_id}

Get details on a single reversal of a payment order.';
    protected const PARAMETERS = array (
  'payment_order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `payment_order_id` from the official Modern Treasury API operation.',
  ),
  'reversal_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `reversal_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/payment_orders/{payment_order_id}/reversals/{reversal_id}';
    protected const PATH_PARAMS = array (
  'payment_order_id' => 'payment_order_id',
  'reversal_id' => 'reversal_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
