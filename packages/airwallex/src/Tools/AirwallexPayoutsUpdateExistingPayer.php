<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Payers > Update existing payer.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/payers/{payer_id}/update.
 */
class AirwallexPayoutsUpdateExistingPayer extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_update_existing_payer';
    protected const DESCRIPTION = 'Payouts > Payers > Update existing payer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/payers/{payer_id}/update.';
    protected const PARAMETERS = [
        'payer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payer_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/payers/{payer_id}/update';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payer_id' => 'payer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
