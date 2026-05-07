<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Billing Transactions > Get a list of Billing Transactions.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/billing_transactions.
 */
class AirwallexBillingGetAListOfBillingTransactions extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_a_list_of_billing_transactions';
    protected const DESCRIPTION = 'Billing > Billing Transactions > Get a list of Billing Transactions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_transactions.';
    protected const PARAMETERS = [
        'invoice_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Query parameter `invoice_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/billing_transactions';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'invoice_id' => 'invoice_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
