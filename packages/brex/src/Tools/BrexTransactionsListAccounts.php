<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List cash accounts.
 *
 * Maps to the official Brex endpoint get /v2/accounts/cash.
 */
class BrexTransactionsListAccounts extends AbstractBrexTool
{
    protected const NAME = 'brex_transactions_list_accounts';
    protected const DESCRIPTION = 'List cash accounts

Official Brex endpoint: GET /v2/accounts/cash

This endpoint lists all the existing cash accounts with their status.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/accounts/cash';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
