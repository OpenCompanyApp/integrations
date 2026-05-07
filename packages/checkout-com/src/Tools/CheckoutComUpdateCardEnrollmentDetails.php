<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update a card's 3DS details.
 *
 * Maps to the official Checkout.com endpoint PATCH /issuing/cards/{cardId}/3ds-enrollment.
 */
class CheckoutComUpdateCardEnrollmentDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_card_enrollment_details';
    protected const DESCRIPTION = 'Updates a card\'s 3DS enrollment details. At least one of the fields is required.

Official Checkout.com endpoint: PATCH /issuing/cards/{cardId}/3ds-enrollment.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/issuing/cards/{cardId}/3ds-enrollment';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
