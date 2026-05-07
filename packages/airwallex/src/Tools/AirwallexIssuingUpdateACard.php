<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Issuing > Cards > Update a card.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/issuing/cards/{card_id}/update.
 */
class AirwallexIssuingUpdateACard extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_issuing_update_a_card';
    protected const DESCRIPTION = 'Issuing > Cards > Update a card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/cards/{card_id}/update.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `card_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/issuing/cards/{card_id}/update';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'card_id' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
