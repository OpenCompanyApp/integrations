<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Request an access token.
 *
 * Maps to the official Checkout.com endpoint POST /connect/token.
 */
class CheckoutComRequestAnAccessToken extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_request_an_access_token';
    protected const DESCRIPTION = 'OAuth endpoint to exchange your access key ID and access key secret for an access token.

Official Checkout.com endpoint: POST /connect/token.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/connect/token';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/x-www-form-urlencoded';
    protected const REQUIRES_AUTH = false;
}
