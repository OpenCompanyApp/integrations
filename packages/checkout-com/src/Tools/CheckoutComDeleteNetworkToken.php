<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Permanently deletes a network token.
 *
 * Maps to the official Checkout.com endpoint PATCH /network-tokens/{network_token_id}/delete.
 */
class CheckoutComDeleteNetworkToken extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_delete_network_token';
    protected const DESCRIPTION = 'Beta This endpoint is for permanently deleting a network token. A network token should be deleted when a payment instrument it is associated with is removed from file or if the security of the token has been compromised.

Official Checkout.com endpoint: PATCH /network-tokens/{network_token_id}/delete.';
    protected const PARAMETERS = [
        'network_token_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Unique token ID assigned by Checkout.com for each token',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/network-tokens/{network_token_id}/delete';
    protected const PATH_PARAMS = [
        'network_token_id' => 'network_token_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
