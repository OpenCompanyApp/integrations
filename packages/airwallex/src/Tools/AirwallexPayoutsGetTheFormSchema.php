<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Beneficiaries > Get the form schema.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/beneficiary_form_schemas/generate.
 */
class AirwallexPayoutsGetTheFormSchema extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_get_the_form_schema';
    protected const DESCRIPTION = 'Payouts > Beneficiaries > Get the form schema.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/beneficiary_form_schemas/generate.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/beneficiary_form_schemas/generate';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
