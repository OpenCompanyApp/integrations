<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Charges > Get a charge by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/charges/{charge_id}.
 */
class AirwallexScaleGetAChargeById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_get_a_charge_by_id';
    protected const DESCRIPTION = 'Scale > Charges > Get a charge by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/charges/{charge_id}.';
    protected const PARAMETERS = [
        'charge_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `charge_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/charges/{charge_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'charge_id' => 'charge_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
