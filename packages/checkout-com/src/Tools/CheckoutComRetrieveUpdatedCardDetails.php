<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get updated card credentials.
 *
 * Maps to the official Checkout.com endpoint POST /account-updater/cards.
 */
class CheckoutComRetrieveUpdatedCardDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_retrieve_updated_card_details';
    protected const DESCRIPTION = 'Retrieve updated card credentials.  The following card schemes are supported: - Mastercard - Visa - American Express

Official Checkout.com endpoint: POST /account-updater/cards.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/account-updater/cards';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
