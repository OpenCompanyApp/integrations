<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List balances.
 *
 * Maps to the official GoCardless endpoint GET /balances.
 */
class GoCardlessListBalance extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_balance';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of balances for a given creditor. This endpoint is rate limited to 60 requests per minute.

Official GoCardless endpoint: GET /balances.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/balances';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
