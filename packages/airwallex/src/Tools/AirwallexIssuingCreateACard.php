<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Issuing > Cards > Create a card.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/issuing/cards/create.
 */
class AirwallexIssuingCreateACard extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_issuing_create_a_card';
    protected const DESCRIPTION = 'Issuing > Cards > Create a card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/cards/create.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/issuing/cards/create';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
