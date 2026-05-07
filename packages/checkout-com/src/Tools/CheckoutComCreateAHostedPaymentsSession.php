<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a Hosted Payments Page session.
 *
 * Maps to the official Checkout.com endpoint POST /hosted-payments.
 */
class CheckoutComCreateAHostedPaymentsSession extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_a_hosted_payments_session';
    protected const DESCRIPTION = 'Create a Hosted Payments Page session and pass through all the payment information, like the amount, currency, country and reference. To get started with our Hosted Payments Page, contact your solutions engineer or request support.

Official Checkout.com endpoint: POST /hosted-payments.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/hosted-payments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
