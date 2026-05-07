<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Upload a payment processing certificate.
 *
 * Maps to the official Checkout.com endpoint POST /applepay/certificates.
 */
class CheckoutComUploadApplePayCertificate extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_upload_apple_pay_certificate';
    protected const DESCRIPTION = 'Upload a payment processing certificate. This will allow you to start processing payments via Apple Pay.

Official Checkout.com endpoint: POST /applepay/certificates.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/applepay/certificates';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
