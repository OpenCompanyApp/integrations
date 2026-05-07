<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Supporting Services > Reference Data > Invalid conversion dates.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/reference/invalid_conversion_dates.
 */
class AirwallexSupportingServicesInvalidConversionDates extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_supporting_services_invalid_conversion_dates';
    protected const DESCRIPTION = 'Supporting Services > Reference Data > Invalid conversion dates.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/reference/invalid_conversion_dates.';
    protected const PARAMETERS = [
        'currency_pair' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Currency pair to get the invalid conversion dates for',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/reference/invalid_conversion_dates';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'currency_pair' => 'currency_pair',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
