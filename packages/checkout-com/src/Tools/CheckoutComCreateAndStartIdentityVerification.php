<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create an identity verification and attempt.
 *
 * Maps to the official Checkout.com endpoint POST /create-and-open-idv.
 */
class CheckoutComCreateAndStartIdentityVerification extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_and_start_identity_verification';
    protected const DESCRIPTION = 'Create an identity verification and attempt

Official Checkout.com endpoint: POST /create-and-open-idv.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/create-and-open-idv';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
