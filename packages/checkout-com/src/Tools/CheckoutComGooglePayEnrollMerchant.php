<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Enroll an entity to the Google Pay Service.
 *
 * Maps to the official Checkout.com endpoint POST /googlepay/enrollments.
 */
class CheckoutComGooglePayEnrollMerchant extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_google_pay_enroll_merchant';
    protected const DESCRIPTION = 'Enroll an entity to the Google Pay Service. You must accept the Google terms of service to use this feature.

Official Checkout.com endpoint: POST /googlepay/enrollments.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/googlepay/enrollments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
