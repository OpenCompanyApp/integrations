<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Enroll a domain to the Apple Pay Service.
 *
 * Maps to the official Checkout.com endpoint POST /applepay/enrollments.
 */
class CheckoutComApplePayEnrollMerchant extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_apple_pay_enroll_merchant';
    protected const DESCRIPTION = 'Enroll a domain to the Apple Pay Service

Official Checkout.com endpoint: POST /applepay/enrollments.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/applepay/enrollments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
