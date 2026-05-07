<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Payers > Delete existing payer.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/payers/{payer_id}/delete.
 */
class AirwallexPayoutsDeleteExistingPayer extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_delete_existing_payer';
    protected const DESCRIPTION = 'Payouts > Payers > Delete existing payer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/payers/{payer_id}/delete.';
    protected const PARAMETERS = [
        'payer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payer_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/payers/{payer_id}/delete';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payer_id' => 'payer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
