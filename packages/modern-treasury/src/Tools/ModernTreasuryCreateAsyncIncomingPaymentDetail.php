<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create async incoming payment detail.
 *
 * Maps to the official Modern Treasury endpoint post /api/simulations/incoming_payment_details/create_async.
 */
class ModernTreasuryCreateAsyncIncomingPaymentDetail extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_async_incoming_payment_detail';
    protected const DESCRIPTION = 'create async incoming payment detail

Official Modern Treasury endpoint: POST /api/simulations/incoming_payment_details/create_async

Simulate Incoming Payment Detail';
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
    protected const PATH = '/api/simulations/incoming_payment_details/create_async';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
