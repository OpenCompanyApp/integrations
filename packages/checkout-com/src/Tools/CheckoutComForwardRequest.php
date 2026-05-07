<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Forward an API request.
 *
 * Maps to the official Checkout.com endpoint POST /forward.
 */
class CheckoutComForwardRequest extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_forward_request';
    protected const DESCRIPTION = 'Beta Forwards an API request to a third-party endpoint. For example, you can forward payment credentials you\'ve stored in our Vault to a third-party payment processor.

Official Checkout.com endpoint: POST /forward.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/forward';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
