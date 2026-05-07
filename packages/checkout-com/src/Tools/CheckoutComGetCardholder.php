<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get cardholder details.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/cardholders/{cardholderId}.
 */
class CheckoutComGetCardholder extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_cardholder';
    protected const DESCRIPTION = 'Retrieve the details for a cardholder you created previously.

Official Checkout.com endpoint: GET /issuing/cardholders/{cardholderId}.';
    protected const PARAMETERS = [
        'cardholder_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardholderId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/cardholders/{cardholderId}';
    protected const PATH_PARAMS = [
        'cardholderId' => 'cardholder_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
