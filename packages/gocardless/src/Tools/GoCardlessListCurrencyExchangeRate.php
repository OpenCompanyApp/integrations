<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List exchange rates.
 *
 * Maps to the official GoCardless endpoint GET /currency_exchange_rates.
 */
class GoCardlessListCurrencyExchangeRate extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_currency_exchange_rate';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of all exchange rates.

Official GoCardless endpoint: GET /currency_exchange_rates.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/currency_exchange_rates';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
