<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Generate a certificate signing request.
 *
 * Maps to the official Checkout.com endpoint POST /applepay/signing-requests.
 */
class CheckoutComGenerateApplePaySigningRequest extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_generate_apple_pay_signing_request';
    protected const DESCRIPTION = 'Generate a certificate signing request. You\'ll need to upload this to your Apple Developer account to download a payment processing certificate.

Official Checkout.com endpoint: POST /applepay/signing-requests.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/applepay/signing-requests';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
