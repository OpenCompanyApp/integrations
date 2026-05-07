<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Reporting > Financial Transactions > Get list of financial transactions.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/financial_transactions.
 */
class AirwallexReportingGetListOfFinancialTransactions extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_reporting_get_list_of_financial_transactions';
    protected const DESCRIPTION = 'Reporting > Financial Transactions > Get list of financial transactions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/financial_transactions.';
    protected const PARAMETERS = [
        'page_size' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Number of results per page, default is 100, max is 1000',
        ],
        'to_created_at' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The end time of created_at in ISO8601 format (inclusive)',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/financial_transactions';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'page_size' => 'page_size',
        'to_created_at' => 'to_created_at',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
