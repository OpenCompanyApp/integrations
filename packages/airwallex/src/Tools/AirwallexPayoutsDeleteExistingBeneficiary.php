<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Beneficiaries > Delete existing beneficiary.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/beneficiaries/{id}/delete.
 */
class AirwallexPayoutsDeleteExistingBeneficiary extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_delete_existing_beneficiary';
    protected const DESCRIPTION = 'Payouts > Beneficiaries > Delete existing beneficiary.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/beneficiaries/{id}/delete.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/beneficiaries/{id}/delete';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
