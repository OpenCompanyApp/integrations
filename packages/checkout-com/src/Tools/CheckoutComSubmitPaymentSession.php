<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Submit a Payment Session.
 *
 * Maps to the official Checkout.com endpoint POST /payment-sessions/{id}/submit.
 */
class CheckoutComSubmitPaymentSession extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_submit_payment_session';
    protected const DESCRIPTION = 'Submit a payment attempt for a payment session. This request works with the Flow handleSubmit callback, where you can perform a customized payment submission. You must send the unmodified response body as the response of the `handleSubmit` callback.

Official Checkout.com endpoint: POST /payment-sessions/{id}/submit.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The Payment Sessions unique identifier',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payment-sessions/{id}/submit';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
