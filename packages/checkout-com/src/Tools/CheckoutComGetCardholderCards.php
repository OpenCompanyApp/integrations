<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get a cardholder's cards.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/cardholders/{cardholderId}/cards.
 */
class CheckoutComGetCardholderCards extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_cardholder_cards';
    protected const DESCRIPTION = 'Retrieves the cards issued to the specified cardholder. Card credentials are not returned in the response. The response is limited to a maximum of 150 cards.

Official Checkout.com endpoint: GET /issuing/cardholders/{cardholderId}/cards.';
    protected const PARAMETERS = [
        'cardholder_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardholderId',
        ],
        'statuses' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The card statuses to filter the results by. Cards matching any status in this list are returned. If the list is empty, all cards are returned. Format - Comma-separated list',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/cardholders/{cardholderId}/cards';
    protected const PATH_PARAMS = [
        'cardholderId' => 'cardholder_id',
    ];
    protected const QUERY_PARAMS = [
        'statuses' => 'statuses',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
