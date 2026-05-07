<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List payouts.
 *
 * Maps to the official GoCardless endpoint GET /payouts.
 */
class GoCardlessListPayout extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_payout';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your payouts.

Official GoCardless endpoint: GET /payouts.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/payouts';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
