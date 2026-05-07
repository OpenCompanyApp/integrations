<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update payment_flow.
 *
 * Maps to the official Modern Treasury endpoint patch /api/payment_flows/{id}.
 */
class ModernTreasuryUpdatePaymentFlow extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_payment_flow';
    protected const DESCRIPTION = 'update payment_flow

Official Modern Treasury endpoint: PATCH /api/payment_flows/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/payment_flows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
