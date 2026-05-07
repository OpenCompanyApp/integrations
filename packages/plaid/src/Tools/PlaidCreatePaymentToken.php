<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create payment token.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/payment/token/create.
 */
class PlaidCreatePaymentToken extends AbstractPlaidTool
{
    protected const NAME = 'plaid_create_payment_token';
    protected const DESCRIPTION = 'Create payment token

Official Plaid endpoint: POST /payment_initiation/payment/token/create

The `/payment_initiation/payment/token/create` endpoint has been deprecated. New Plaid customers will be unable to use this endpoint, and existing customers are encouraged to migrate to the newer, `link_token`-based flow. The recommended flow is to provide the `payment_id` to `/link/token/create`, which returns a `link_token` used to initialize Link. The `/payment_initiation/payment/token/create` is used to create a `payment_token`, which can then be used in Link initialization to enter a payment initiation flow. You can only use a `payment_token` once. If this attempt fails, the end user aborts the flow, or the token expires, you will need to create a new payment token. Creating a new pa...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/payment/token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}