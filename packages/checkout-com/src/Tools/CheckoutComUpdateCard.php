<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update card details.
 *
 * Maps to the official Checkout.com endpoint PATCH /issuing/cards/{cardId}.
 */
class CheckoutComUpdateCard extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_card';
    protected const DESCRIPTION = 'Update the details of an issued card. Only the fields for which you provide values will be updated. If you pass `null`, the existing value will be removed.

Official Checkout.com endpoint: PATCH /issuing/cards/{cardId}.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardId',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/issuing/cards/{cardId}';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
