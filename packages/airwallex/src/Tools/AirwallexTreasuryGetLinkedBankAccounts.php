<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Treasury > Direct Debit LBA > Get Linked Bank Accounts.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/linked_accounts.
 */
class AirwallexTreasuryGetLinkedBankAccounts extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_treasury_get_linked_bank_accounts';
    protected const DESCRIPTION = 'Treasury > Direct Debit LBA > Get Linked Bank Accounts.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/linked_accounts.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/linked_accounts';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
