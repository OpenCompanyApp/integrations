<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Transactional FX > Conversion > Retrieve a specific conversion.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/fx/conversions/{conversion_id}.
 */
class AirwallexTransactionalFxRetrieveASpecificConversion extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_transactional_fx_retrieve_a_specific_conversion';
    protected const DESCRIPTION = 'Transactional FX > Conversion > Retrieve a specific conversion.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/fx/conversions/{conversion_id}.';
    protected const PARAMETERS = [
        'conversion_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `conversion_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/fx/conversions/{conversion_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'conversion_id' => 'conversion_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
