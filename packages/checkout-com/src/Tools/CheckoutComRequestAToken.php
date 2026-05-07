<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Request a token.
 *
 * Maps to the official Checkout.com endpoint POST /tokens.
 */
class CheckoutComRequestAToken extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_request_a_token';
    protected const DESCRIPTION = 'Exchange card details for a reference token that can be used later to request a card payment. Tokens are single use and expire after 15 minutes. To create a token, please authenticate using your public key. **Please note:** You should only use the `card` type for testing purposes.

Official Checkout.com endpoint: POST /tokens.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/tokens';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
