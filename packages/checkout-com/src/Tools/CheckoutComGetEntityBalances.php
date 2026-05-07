<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Retrieve entity balances.
 *
 * Maps to the official Checkout.com endpoint GET /balances/{id}.
 */
class CheckoutComGetEntityBalances extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_entity_balances';
    protected const DESCRIPTION = 'Use this endpoint to retrieve balances for each sub-account in an entity. *Note:* The sub-account is referred to as _currency account_ in the API.

Official Checkout.com endpoint: GET /balances/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the entity.',
        ],
        'query' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The query to apply to limit the currency accounts.',
        ],
        'with_currency_account_id' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Specifies if the response should include the sub-account ID that corresponds to each set of balances.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/balances/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'query' => 'query',
        'withCurrencyAccountId' => 'with_currency_account_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
