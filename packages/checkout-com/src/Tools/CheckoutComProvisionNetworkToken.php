<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Provision a Network Token.
 *
 * Maps to the official Checkout.com endpoint POST /network-tokens.
 */
class CheckoutComProvisionNetworkToken extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_provision_network_token';
    protected const DESCRIPTION = 'Beta Provisions a network token synchronously. If the merchant stores their cards with Checkout.com, then source ID can be used to request a network token for the given card. If the merchant does not store their cards with Checkout.com, then card details have to be provided.

Official Checkout.com endpoint: POST /network-tokens.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/network-tokens';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
