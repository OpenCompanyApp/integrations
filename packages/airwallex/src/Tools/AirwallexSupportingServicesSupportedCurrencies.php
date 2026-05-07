<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Supporting Services > Reference Data > Supported currencies.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/reference/supported_currencies.
 */
class AirwallexSupportingServicesSupportedCurrencies extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_supporting_services_supported_currencies';
    protected const DESCRIPTION = 'Supporting Services > Reference Data > Supported currencies.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/reference/supported_currencies.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/reference/supported_currencies';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
