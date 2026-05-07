<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get control details.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/controls/{controlId}.
 */
class CheckoutComGetControl extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_control';
    protected const DESCRIPTION = 'Retrieves the details of an existing control.

Official Checkout.com endpoint: GET /issuing/controls/{controlId}.';
    protected const PARAMETERS = [
        'control_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'controlId',
        ],
        'card_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The unique identifier for the card you want to get the remaining cascading velocity control for.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/controls/{controlId}';
    protected const PATH_PARAMS = [
        'controlId' => 'control_id',
    ];
    protected const QUERY_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
