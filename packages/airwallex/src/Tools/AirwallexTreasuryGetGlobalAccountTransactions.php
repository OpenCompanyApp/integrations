<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Treasury > Global Accounts > Get global account transactions.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/global_accounts/{global_account_id}/transactions.
 */
class AirwallexTreasuryGetGlobalAccountTransactions extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_treasury_get_global_account_transactions';
    protected const DESCRIPTION = 'Treasury > Global Accounts > Get global account transactions.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/global_accounts/{global_account_id}/transactions.';
    protected const PARAMETERS = [
        'global_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `global_account_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/global_accounts/{global_account_id}/transactions';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'global_account_id' => 'global_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
