<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Accounts > Submit account for activation.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/accounts/{connected_account_id}/submit.
 */
class AirwallexScaleSubmitAccountForActivation extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_submit_account_for_activation';
    protected const DESCRIPTION = 'Scale > Accounts > Submit account for activation.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/accounts/{connected_account_id}/submit.';
    protected const PARAMETERS = [
        'connected_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `connected_account_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/accounts/{connected_account_id}/submit';
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
