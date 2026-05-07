<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Delete an instrument.
 *
 * Maps to the official Checkout.com endpoint DELETE /instruments/{id}.
 */
class CheckoutComDeleteInstrument extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_delete_instrument';
    protected const DESCRIPTION = 'Delete a payment instrument.

Official Checkout.com endpoint: DELETE /instruments/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the payment instrument to be deleted',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/instruments/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
