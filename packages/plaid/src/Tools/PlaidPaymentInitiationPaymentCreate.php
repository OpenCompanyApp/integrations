<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a payment.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/payment/create.
 */
class PlaidPaymentInitiationPaymentCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_payment_create';
    protected const DESCRIPTION = 'Create a payment

Official Plaid endpoint: POST /payment_initiation/payment/create

After creating a payment recipient, you can use the `/payment_initiation/payment/create` endpoint to create a payment to that recipient. Payments can be one-time or standing order (recurring) and can be denominated in either EUR, GBP or other chosen [currency](https://plaid.com/docs/api/products/payment-initiation/#payment_initiation-payment-create-request-amount-currency). If making domestic GBP-denominated payments, your recipient must have been created with BACS numbers. In general, EUR-denominated payments will be sent via SEPA Credit Transfer, GBP-denominated payments will be sent via the Faster Payments network and for non-Eurozone markets typically via the local payment scheme, but...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/payment/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}