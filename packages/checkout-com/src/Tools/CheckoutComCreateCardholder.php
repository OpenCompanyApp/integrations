<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a cardholder.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/cardholders.
 */
class CheckoutComCreateCardholder extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_cardholder';
    protected const DESCRIPTION = 'Create a new cardholder that you can issue a card to at a later point.

Official Checkout.com endpoint: POST /issuing/cardholders.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/cardholders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
