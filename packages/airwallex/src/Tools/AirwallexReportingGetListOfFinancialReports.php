<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Reporting > Financial Reports > Get list of financial reports.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/finance/financial_reports.
 */
class AirwallexReportingGetListOfFinancialReports extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_reporting_get_list_of_financial_reports';
    protected const DESCRIPTION = 'Reporting > Financial Reports > Get list of financial reports.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/finance/financial_reports.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/finance/financial_reports';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
