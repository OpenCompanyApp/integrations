<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Issuing > Cards > Activate a card.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/issuing/cards/{card_id}/activate.
 */
class AirwallexIssuingActivateACard extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_issuing_activate_a_card';
    protected const DESCRIPTION = 'Issuing > Cards > Activate a card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/issuing/cards/{card_id}/activate.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `card_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/issuing/cards/{card_id}/activate';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'card_id' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
