<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Issuing > Cardholders > Update a cardholder.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/issuing/cardholders/{cardholder_id}/update.
 */
class AirwallexIssuingUpdateACardholder extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_issuing_update_a_cardholder';
    protected const DESCRIPTION = 'Issuing > Cardholders > Update a cardholder.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/cardholders/{cardholder_id}/update.';
    protected const PARAMETERS = [
        'cardholder_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `cardholder_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/issuing/cardholders/{cardholder_id}/update';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'cardholder_id' => 'cardholder_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
