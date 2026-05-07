<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Reporting > Settlements > Get a settlement report by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/financial/settlements/{settlement_id}/report.
 */
class AirwallexReportingGetASettlementReportById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_reporting_get_a_settlement_report_by_id';
    protected const DESCRIPTION = 'Reporting > Settlements > Get a settlement report by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/financial/settlements/{settlement_id}/report.';
    protected const PARAMETERS = [
        'settlement_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `settlement_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/financial/settlements/{settlement_id}/report';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'settlement_id' => 'settlement_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
