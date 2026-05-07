<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Revoke a card.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/cards/{cardId}/revoke.
 */
class CheckoutComRevokeCard extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_revoke_card';
    protected const DESCRIPTION = 'Revokes an `inactive`, `active`, or `suspended` card to permanently decline all incoming authorizations. This is a permanent action. Revoked cards cannot be reactivated.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/revoke.';
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
    protected const PATH = '/issuing/cards/{cardId}/revoke';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
