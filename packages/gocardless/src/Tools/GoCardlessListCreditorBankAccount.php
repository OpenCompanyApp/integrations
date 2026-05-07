<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List creditor bank accounts.
 *
 * Maps to the official GoCardless endpoint GET /creditor_bank_accounts.
 */
class GoCardlessListCreditorBankAccount extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_creditor_bank_account';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your creditor bank accounts.

Official GoCardless endpoint: GET /creditor_bank_accounts.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/creditor_bank_accounts';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
