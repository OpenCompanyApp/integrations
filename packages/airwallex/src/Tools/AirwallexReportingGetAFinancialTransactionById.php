<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Reporting > Financial Transactions > Get a financial transaction by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/financial_transactions/{financial_transaction_id}.
 */
class AirwallexReportingGetAFinancialTransactionById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_reporting_get_a_financial_transaction_by_id';
    protected const DESCRIPTION = 'Reporting > Financial Transactions > Get a financial transaction by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/financial_transactions/{financial_transaction_id}.';
    protected const PARAMETERS = [
        'financial_transaction_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `financial_transaction_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/financial_transactions/{financial_transaction_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'financial_transaction_id' => 'financial_transaction_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
