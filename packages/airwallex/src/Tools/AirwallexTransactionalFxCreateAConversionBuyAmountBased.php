<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Transactional FX > Conversion > Create a conversion - buy_amount based.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/fx/conversions/create.
 */
class AirwallexTransactionalFxCreateAConversionBuyAmountBased extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_transactional_fx_create_a_conversion_buy_amount_based';
    protected const DESCRIPTION = 'Transactional FX > Conversion > Create a conversion - buy_amount based.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/fx/conversions/create.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/fx/conversions/create';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
