<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get primary cash account.
 *
 * Maps to the official Brex endpoint get /v2/accounts/cash/primary.
 */
class BrexTransactionsGetPrimaryAccount extends AbstractBrexTool
{
    protected const NAME = 'brex_transactions_get_primary_account';
    protected const DESCRIPTION = 'Get primary cash account

Official Brex endpoint: GET /v2/accounts/cash/primary

This endpoint returns the primary cash account with its status. There will always be only one primary account.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/accounts/cash/primary';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
