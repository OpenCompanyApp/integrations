<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get card metadata.
 *
 * Maps to the official Checkout.com endpoint POST /metadata/card.
 */
class CheckoutComRequestCardMetadata extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_request_card_metadata';
    protected const DESCRIPTION = 'Beta Returns a single metadata record for the card specified by the Primary Account Number (PAN), Bank Identification Number (BIN), token, or instrument supplied.

Official Checkout.com endpoint: POST /metadata/card.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/metadata/card';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
