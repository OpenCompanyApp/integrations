<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update a cardholder.
 *
 * Maps to the official Checkout.com endpoint PATCH /issuing/cardholders/{cardholderId}.
 */
class CheckoutComUpdateCardholder extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_cardholder';
    protected const DESCRIPTION = 'Updates the details of an existing cardholder.

Official Checkout.com endpoint: PATCH /issuing/cardholders/{cardholderId}.';
    protected const PARAMETERS = [
        'cardholder_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardholderId',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/issuing/cardholders/{cardholderId}';
    protected const PATH_PARAMS = [
        'cardholderId' => 'cardholder_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
