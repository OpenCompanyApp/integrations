<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Activate a card.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/cards/{cardId}/activate.
 */
class CheckoutComActivateCard extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_activate_card';
    protected const DESCRIPTION = 'Activates an `inactive` or `suspended` card so that incoming authorizations can be approved. Activating a renewed card will schedule the parent card for revocation the following day, and transfer all configurations to the newly activated card. This includes 3DS enrollment, card controls, control profiles and tokenisation.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/activate.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardId',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/cards/{cardId}/activate';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
