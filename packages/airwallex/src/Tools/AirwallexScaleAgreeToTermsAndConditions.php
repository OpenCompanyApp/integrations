<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Accounts > Agree to terms and conditions.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/accounts/{connected_account_id}/terms_and_conditions/agree.
 */
class AirwallexScaleAgreeToTermsAndConditions extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_agree_to_terms_and_conditions';
    protected const DESCRIPTION = 'Scale > Accounts > Agree to terms and conditions.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/{connected_account_id}/terms_and_conditions/agree.';
    protected const PARAMETERS = [
        'connected_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `connected_account_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/accounts/{connected_account_id}/terms_and_conditions/agree';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'connected_account_id' => 'connected_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
