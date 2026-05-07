<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Beneficiaries > Get a beneficiary by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/beneficiaries/{beneficiary_id}.
 */
class AirwallexPayoutsGetABeneficiaryById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_get_a_beneficiary_by_id';
    protected const DESCRIPTION = 'Payouts > Beneficiaries > Get a beneficiary by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/beneficiaries/{beneficiary_id}.';
    protected const PARAMETERS = [
        'beneficiary_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `beneficiary_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/beneficiaries/{beneficiary_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'beneficiary_id' => 'beneficiary_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
