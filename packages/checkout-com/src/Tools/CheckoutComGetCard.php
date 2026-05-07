<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get card details.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/cards/{cardId}.
 */
class CheckoutComGetCard extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_card';
    protected const DESCRIPTION = 'Retrieves the details for a card you issued previously. The card\'s credentials are not returned in the response.

Official Checkout.com endpoint: GET /issuing/cards/{cardId}.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/cards/{cardId}';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
