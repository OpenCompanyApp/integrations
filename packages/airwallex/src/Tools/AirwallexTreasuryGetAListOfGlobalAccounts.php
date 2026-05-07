<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Treasury > Global Accounts > Get a list of global accounts.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/global_accounts.
 */
class AirwallexTreasuryGetAListOfGlobalAccounts extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_treasury_get_a_list_of_global_accounts';
    protected const DESCRIPTION = 'Treasury > Global Accounts > Get a list of global accounts.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/global_accounts.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/global_accounts';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
