<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get financial actions.
 *
 * Maps to the official Checkout.com endpoint GET /financial-actions.
 */
class CheckoutComGetFinancialActions extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_financial_actions';
    protected const DESCRIPTION = 'Returns the list of financial actions and their details.

Official Checkout.com endpoint: GET /financial-actions.';
    protected const PARAMETERS = [
        'payment_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The ID of the payment you want to retrieve financial actions for. Required if `action_id` is not used.',
        ],
        'action_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The ID of the action you want to retrieve financial actions for. Required if `payment_id` is not used.',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The number of results to retrieve per page. </br> For example, if the total result count is 50, and you use `limit=10`, you will need to iterate over 5 pages containing 10 results each to retrieve all of the reports that match your query.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A token used for pagination when a response contains results across multiple pages.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/financial-actions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'payment_id' => 'payment_id',
        'action_id' => 'action_id',
        'limit' => 'limit',
        'pagination_token' => 'pagination_token',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
