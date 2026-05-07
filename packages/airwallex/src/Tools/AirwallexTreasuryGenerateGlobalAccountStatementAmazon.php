<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Treasury > Global Accounts > Generate global account statement - AMAZON.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/global_accounts/{global_account_id}/generate_statement_letter.
 */
class AirwallexTreasuryGenerateGlobalAccountStatementAmazon extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_treasury_generate_global_account_statement_amazon';
    protected const DESCRIPTION = 'Treasury > Global Accounts > Generate global account statement - AMAZON.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/global_accounts/{global_account_id}/generate_statement_letter.';
    protected const PARAMETERS = [
        'global_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `global_account_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/global_accounts/{global_account_id}/generate_statement_letter';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'global_account_id' => 'global_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
