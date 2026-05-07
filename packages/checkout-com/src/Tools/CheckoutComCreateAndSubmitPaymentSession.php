<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Request a Payment Session with Payment.
 *
 * Maps to the official Checkout.com endpoint POST /payment-sessions/complete.
 */
class CheckoutComCreateAndSubmitPaymentSession extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_and_submit_payment_session';
    protected const DESCRIPTION = 'Request a Payment Session with Payment

Official Checkout.com endpoint: POST /payment-sessions/complete.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payment-sessions/complete';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
