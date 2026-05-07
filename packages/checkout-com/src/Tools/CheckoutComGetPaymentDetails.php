<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get payment details.
 *
 * Maps to the official Checkout.com endpoint GET /payments/{id}.
 */
class CheckoutComGetPaymentDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_payment_details';
    protected const DESCRIPTION = 'Returns the details of the payment with the specified identifier string. If the payment method requires a redirection to a third party (e.g., 3D Secure), the redirect URL back to your site will include a `cko-session-id` query parameter containing a payment session ID that can be used to obtain the details of the payment, for example: https://example.com/success?cko-session-id=sid_ubfj2q76miwundwlk72vxt2i7q.

Official Checkout.com endpoint: GET /payments/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payment or payment session identifier',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payments/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
