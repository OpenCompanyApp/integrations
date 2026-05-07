<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create an instrument.
 *
 * Maps to the official Checkout.com endpoint POST /instruments.
 */
class CheckoutComCreateAnInstrument extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_an_instrument';
    protected const DESCRIPTION = 'Create a payment instrument like card, bank, ach or sepa to use for future payments and payouts. The parameters you need to provide when creating a bank account payment instrument depend on the account\'s country and currency. See the payout formatting documentation, or use the `GET /validation/bank-accounts/{country}/{currency}` endpoint.

Official Checkout.com endpoint: POST /instruments.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/instruments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
