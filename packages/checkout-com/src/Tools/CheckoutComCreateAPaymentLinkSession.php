<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a Payment Link.
 *
 * Maps to the official Checkout.com endpoint POST /payment-links.
 */
class CheckoutComCreateAPaymentLinkSession extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_a_payment_link_session';
    protected const DESCRIPTION = 'Create a Payment Link and pass through all the payment information, like the amount, currency, country and reference.

Official Checkout.com endpoint: POST /payment-links.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payment-links';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
