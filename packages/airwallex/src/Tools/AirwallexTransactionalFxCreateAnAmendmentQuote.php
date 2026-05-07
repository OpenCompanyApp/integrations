<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Transactional FX > Conversion Amendments > Create an amendment quote.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/fx/conversion_amendments/quote.
 */
class AirwallexTransactionalFxCreateAnAmendmentQuote extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_transactional_fx_create_an_amendment_quote';
    protected const DESCRIPTION = 'Transactional FX > Conversion Amendments > Create an amendment quote.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/fx/conversion_amendments/quote.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/fx/conversion_amendments/quote';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
