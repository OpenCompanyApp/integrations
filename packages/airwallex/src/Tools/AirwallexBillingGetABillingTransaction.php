<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Billing Transactions > Get a Billing Transaction.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/billing_transactions/{billing_transaction_id}.
 */
class AirwallexBillingGetABillingTransaction extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_a_billing_transaction';
    protected const DESCRIPTION = 'Billing > Billing Transactions > Get a Billing Transaction.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_transactions/{billing_transaction_id}.';
    protected const PARAMETERS = [
        'billing_transaction_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `billing_transaction_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/billing_transactions/{billing_transaction_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'billing_transaction_id' => 'billing_transaction_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
