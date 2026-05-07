<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List negative balance limits.
 *
 * Maps to the official GoCardless endpoint GET /negative_balance_limits.
 */
class GoCardlessListNegativeBalanceLimit extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_negative_balance_limit';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of negative balance limits.

Official GoCardless endpoint: GET /negative_balance_limits.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/negative_balance_limits';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
