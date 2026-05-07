<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get the card credentials.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/cards/{cardId}/credentials.
 */
class CheckoutComGetCardCredentials extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_card_credentials';
    protected const DESCRIPTION = 'Retrieves the credentials for a card you issued previously.

Official Checkout.com endpoint: GET /issuing/cards/{cardId}/credentials.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardId',
        ],
        'credentials' => [
            'type' => 'string',
            'required' => false,
            'description' => 'credentials',
            'enum' => ['number', 'cvc2', 'number,cvc2'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/cards/{cardId}/credentials';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [
        'credentials' => 'credentials',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
