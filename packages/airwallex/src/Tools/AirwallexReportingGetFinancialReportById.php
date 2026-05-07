<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Reporting > Financial Reports > Get financial report by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/finance/financial_reports/{report_id}.
 */
class AirwallexReportingGetFinancialReportById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_reporting_get_financial_report_by_id';
    protected const DESCRIPTION = 'Reporting > Financial Reports > Get financial report by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/finance/financial_reports/{report_id}.';
    protected const PARAMETERS = [
        'report_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `report_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/finance/financial_reports/{report_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'report_id' => 'report_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
