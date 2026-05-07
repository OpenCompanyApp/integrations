<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Request a Payment Session.
 *
 * Maps to the official Checkout.com endpoint POST /payment-sessions.
 */
class CheckoutComCreatePaymentSession extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_payment_session';
    protected const DESCRIPTION = 'Creates a payment session. The values you provide in the request will be used to determine the payment methods available to Flow. Some payment methods may require you to provide specific values for certain fields. Refer to our documentation for more information. You must supply the unmodified response body when you initialize Flow.

Official Checkout.com endpoint: POST /payment-sessions.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payment-sessions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
