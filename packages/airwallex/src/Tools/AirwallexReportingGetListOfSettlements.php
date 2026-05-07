<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Reporting > Settlements > Get list of settlements.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/financial/settlements.
 */
class AirwallexReportingGetListOfSettlements extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_reporting_get_list_of_settlements';
    protected const DESCRIPTION = 'Reporting > Settlements > Get list of settlements.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/financial/settlements.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/financial/settlements';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
