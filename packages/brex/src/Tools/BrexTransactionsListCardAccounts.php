<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List card accounts.
 *
 * Maps to the official Brex endpoint get /v2/accounts/card.
 */
class BrexTransactionsListCardAccounts extends AbstractBrexTool
{
    protected const NAME = 'brex_transactions_list_card_accounts';
    protected const DESCRIPTION = 'List card accounts

Official Brex endpoint: GET /v2/accounts/card

This endpoint lists all accounts of card type.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/accounts/card';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
