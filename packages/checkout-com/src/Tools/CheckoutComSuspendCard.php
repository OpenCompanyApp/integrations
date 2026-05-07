<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Suspend a card.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/cards/{cardId}/suspend.
 */
class CheckoutComSuspendCard extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_suspend_card';
    protected const DESCRIPTION = 'Suspends an `active` or `inactive` card to temporarily decline all incoming authorizations. A `suspended` card can be reactivated.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/suspend.';
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
    protected const PATH = '/issuing/cards/{cardId}/suspend';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
