<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get payment_action.
 *
 * Maps to the official Modern Treasury endpoint get /api/payment_actions/{id}.
 */
class ModernTreasuryGetPaymentAction extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_payment_action';
    protected const DESCRIPTION = 'get payment_action

Official Modern Treasury endpoint: GET /api/payment_actions/{id}

Get details on a single payment action.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/payment_actions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
