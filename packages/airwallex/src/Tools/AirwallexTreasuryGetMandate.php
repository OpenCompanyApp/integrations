<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Treasury > Direct Debit LBA > Get mandate.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/linked_accounts/{linked_account_id}/mandate.
 */
class AirwallexTreasuryGetMandate extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_treasury_get_mandate';
    protected const DESCRIPTION = 'Treasury > Direct Debit LBA > Get mandate.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/linked_accounts/{linked_account_id}/mandate.';
    protected const PARAMETERS = [
        'linked_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `linked_account_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/linked_accounts/{linked_account_id}/mandate';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'linked_account_id' => 'linked_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
