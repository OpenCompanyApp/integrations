<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Transfers > Get transfer by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/transfers/{transfer_id}.
 */
class AirwallexPayoutsGetTransferById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_get_transfer_by_id';
    protected const DESCRIPTION = 'Payouts > Transfers > Get transfer by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/transfers/{transfer_id}.';
    protected const PARAMETERS = [
        'transfer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `transfer_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/transfers/{transfer_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'transfer_id' => 'transfer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
