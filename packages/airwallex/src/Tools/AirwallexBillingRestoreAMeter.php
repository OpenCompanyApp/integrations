<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Meters > Restore a Meter.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/meters/{meter_id}/restore.
 */
class AirwallexBillingRestoreAMeter extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_restore_a_meter';
    protected const DESCRIPTION = 'Billing > Meters > Restore a Meter.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/meters/{meter_id}/restore.';
    protected const PARAMETERS = [
        'meter_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `meter_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/meters/{meter_id}/restore';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'meter_id' => 'meter_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
