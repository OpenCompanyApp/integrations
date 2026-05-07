<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List payment accounts.
 *
 * Maps to the official GoCardless endpoint GET /payment_accounts.
 */
class GoCardlessListPaymentAccount extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_payment_account';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your payment accounts.

Official GoCardless endpoint: GET /payment_accounts.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/payment_accounts';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
