<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Beneficiaries > Update existing beneficiary.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/beneficiaries/{beneficiary_id}/update.
 */
class AirwallexPayoutsUpdateExistingBeneficiary extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_update_existing_beneficiary';
    protected const DESCRIPTION = 'Payouts > Beneficiaries > Update existing beneficiary.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/beneficiaries/{beneficiary_id}/update.';
    protected const PARAMETERS = [
        'beneficiary_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `beneficiary_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/beneficiaries/{beneficiary_id}/update';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'beneficiary_id' => 'beneficiary_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
