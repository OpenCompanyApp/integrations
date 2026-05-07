<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get payment order.
 *
 * Maps to the official Modern Treasury endpoint get /api/payment_orders/{id}.
 */
class ModernTreasuryGetPaymentOrder extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_payment_order';
    protected const DESCRIPTION = 'get payment order

Official Modern Treasury endpoint: GET /api/payment_orders/{id}

Get details on a single payment order';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
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
