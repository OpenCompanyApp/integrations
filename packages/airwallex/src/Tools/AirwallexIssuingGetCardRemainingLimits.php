<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Issuing > Cards > Get card remaining limits.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/issuing/cards/{card_id}/limits.
 */
class AirwallexIssuingGetCardRemainingLimits extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_issuing_get_card_remaining_limits';
    protected const DESCRIPTION = 'Issuing > Cards > Get card remaining limits.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/cards/{card_id}/limits.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `card_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/issuing/cards/{card_id}/limits';
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
