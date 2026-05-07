<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Accounts > Create an account - Business.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/accounts/create.
 */
class AirwallexScaleCreateAnAccountBusiness extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_create_an_account_business';
    protected const DESCRIPTION = 'Scale > Accounts > Create an account - Business.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/create.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/accounts/create';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
