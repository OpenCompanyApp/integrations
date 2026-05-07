<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Issuing > Cardholders > Get cardholder details.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/issuing/cardholders/{cardholder_id}.
 */
class AirwallexIssuingGetCardholderDetails extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_issuing_get_cardholder_details';
    protected const DESCRIPTION = 'Issuing > Cardholders > Get cardholder details.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/cardholders/{cardholder_id}.';
    protected const PARAMETERS = [
        'cardholder_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `cardholder_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/issuing/cardholders/{cardholder_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'cardholder_id' => 'cardholder_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
