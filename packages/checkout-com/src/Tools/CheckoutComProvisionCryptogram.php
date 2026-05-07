<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Request a cryptogram.
 *
 * Maps to the official Checkout.com endpoint POST /network-tokens/{network_token_id}/cryptograms.
 */
class CheckoutComProvisionCryptogram extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_provision_cryptogram';
    protected const DESCRIPTION = 'Beta Using network token ID as an input, this endpoint returns token cryptogram.

Official Checkout.com endpoint: POST /network-tokens/{network_token_id}/cryptograms.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/network-tokens/{network_token_id}/cryptograms';
    protected const PATH_PARAMS = [
        'network_token_id' => 'network_token_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
