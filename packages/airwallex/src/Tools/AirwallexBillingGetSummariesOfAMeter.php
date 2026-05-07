<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Meters > Get summaries of a Meter.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/meters/{meter_id}/summaries.
 */
class AirwallexBillingGetSummariesOfAMeter extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_summaries_of_a_meter';
    protected const DESCRIPTION = 'Billing > Meters > Get summaries of a Meter.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/meters/{meter_id}/summaries.';
    protected const PARAMETERS = [
        'meter_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `meter_id`.',
        ],
        'billing_customer_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Query parameter `billing_customer_id`.',
        ],
        'from_happened_at' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Query parameter `from_happened_at`.',
        ],
        'to_happened_at' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Query parameter `to_happened_at`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/meters/{meter_id}/summaries';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'meter_id' => 'meter_id',
    ];
    protected const QUERY_PARAMS = [
        'billing_customer_id' => 'billing_customer_id',
        'from_happened_at' => 'from_happened_at',
        'to_happened_at' => 'to_happened_at',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
