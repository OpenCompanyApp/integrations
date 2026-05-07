<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get payment details.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/payment/get.
 */
class PlaidPaymentInitiationPaymentGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_payment_get';
    protected const DESCRIPTION = 'Get payment details

Official Plaid endpoint: POST /payment_initiation/payment/get

The `/payment_initiation/payment/get` endpoint can be used to check the status of a payment, as well as to receive basic information such as recipient and payment amount. In the case of standing orders, the `/payment_initiation/payment/get` endpoint will provide information about the status of the overall standing order itself; the API cannot be used to retrieve payment status for individual payments within a standing order. Polling for status updates in Production is highly discouraged. Repeatedly calling `/payment_initiation/payment/get` to check a payment\'s status is unreliable and may trigger API rate limits. Only the `payment_status_update` webhook should be used to receive real-time...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/payment/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}