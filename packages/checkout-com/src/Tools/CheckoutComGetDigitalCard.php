<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get digital card details.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/digital-cards/{digitalCardId}.
 */
class CheckoutComGetDigitalCard extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_digital_card';
    protected const DESCRIPTION = 'Retrieves the details for a digital card.

Official Checkout.com endpoint: GET /issuing/digital-cards/{digitalCardId}.';
    protected const PARAMETERS = [
        'digital_card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'digitalCardId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/digital-cards/{digitalCardId}';
    protected const PATH_PARAMS = [
        'digitalCardId' => 'digital_card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
