<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Simulate a payment event in Sandbox.
 *
 * Maps to the official Plaid endpoint post /sandbox/payment/simulate.
 */
class PlaidSandboxPaymentSimulate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_payment_simulate';
    protected const DESCRIPTION = 'Simulate a payment event in Sandbox

Official Plaid endpoint: POST /sandbox/payment/simulate

Use the `/sandbox/payment/simulate` endpoint to simulate various payment events in the Sandbox environment. This endpoint will trigger the corresponding payment status webhook.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/payment/simulate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}