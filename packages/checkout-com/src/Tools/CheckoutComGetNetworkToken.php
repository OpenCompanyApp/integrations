<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get Network Token.
 *
 * Maps to the official Checkout.com endpoint GET /network-tokens/{network_token_id}.
 */
class CheckoutComGetNetworkToken extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_network_token';
    protected const DESCRIPTION = 'Beta Given network token ID, this endpoint returns network token details: DPAN, expiry date, state, TRID and also card details like last four and expiry date.

Official Checkout.com endpoint: GET /network-tokens/{network_token_id}.';
    protected const PARAMETERS = [
        'network_token_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Unique token ID assigned by Checkout.com for each token',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/network-tokens/{network_token_id}';
    protected const PATH_PARAMS = [
        'network_token_id' => 'network_token_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
