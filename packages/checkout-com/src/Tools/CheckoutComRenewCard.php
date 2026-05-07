<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Renew a card.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/cards/{cardId}/renew.
 */
class CheckoutComRenewCard extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_renew_card';
    protected const DESCRIPTION = 'Renew a card

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/renew.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardId',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/cards/{cardId}/renew';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
