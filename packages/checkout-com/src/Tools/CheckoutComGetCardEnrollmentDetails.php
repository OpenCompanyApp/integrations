<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get a card's 3DS enrollment details.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/cards/{cardId}/3ds-enrollment.
 */
class CheckoutComGetCardEnrollmentDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_card_enrollment_details';
    protected const DESCRIPTION = 'Retrieves a card\'s 3DS enrollment details.

Official Checkout.com endpoint: GET /issuing/cards/{cardId}/3ds-enrollment.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/cards/{cardId}/3ds-enrollment';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
