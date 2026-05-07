<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get instrument details.
 *
 * Maps to the official Checkout.com endpoint GET /instruments/{id}.
 */
class CheckoutComGetInstrumentDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_instrument_details';
    protected const DESCRIPTION = 'Retrieve the details of a payment instrument.

Official Checkout.com endpoint: GET /instruments/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The instrument ID',
        ],
    ];
    protected const METHOD = 'GET';
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
