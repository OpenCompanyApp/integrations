<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Reporting > Financial Reports > Get contents of a financial report.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/finance/financial_reports/{report_id}/content.
 */
class AirwallexReportingGetContentsOfAFinancialReport extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_reporting_get_contents_of_a_financial_report';
    protected const DESCRIPTION = 'Reporting > Financial Reports > Get contents of a financial report.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/finance/financial_reports/{report_id}/content.';
    protected const PARAMETERS = [
        'report_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `report_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/finance/financial_reports/{report_id}/content';
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
