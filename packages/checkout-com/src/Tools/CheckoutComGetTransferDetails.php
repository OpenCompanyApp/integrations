<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Retrieve a transfer.
 *
 * Maps to the official Checkout.com endpoint GET /transfers/{id}.
 */
class CheckoutComGetTransferDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_transfer_details';
    protected const DESCRIPTION = 'Retrieve transfer details using the transfer identifier.

Official Checkout.com endpoint: GET /transfers/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The transfer identifier',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/transfers/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
