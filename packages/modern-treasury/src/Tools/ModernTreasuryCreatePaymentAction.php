<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create payment_action.
 *
 * Maps to the official Modern Treasury endpoint post /api/payment_actions.
 */
class ModernTreasuryCreatePaymentAction extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_payment_action';
    protected const DESCRIPTION = 'create payment_action

Official Modern Treasury endpoint: POST /api/payment_actions

Create a payment action.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/payment_actions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
