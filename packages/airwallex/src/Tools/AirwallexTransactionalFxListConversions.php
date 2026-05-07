<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Transactional FX > Conversion > List conversions.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/fx/conversions.
 */
class AirwallexTransactionalFxListConversions extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_transactional_fx_list_conversions';
    protected const DESCRIPTION = 'Transactional FX > Conversion > List conversions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/fx/conversions.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/fx/conversions';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
