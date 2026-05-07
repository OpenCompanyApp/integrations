<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Issuing > Authorizations > Get single authorization status.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/issuing/authorizations/{issuing_transaction_id}.
 */
class AirwallexIssuingGetSingleAuthorizationStatus extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_issuing_get_single_authorization_status';
    protected const DESCRIPTION = 'Issuing > Authorizations > Get single authorization status.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/authorizations/{issuing_transaction_id}.';
    protected const PARAMETERS = [
        'issuing_transaction_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `issuing_transaction_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/issuing/authorizations/{issuing_transaction_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'issuing_transaction_id' => 'issuing_transaction_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
