<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List tax rates.
 *
 * Maps to the official GoCardless endpoint GET /tax_rates.
 */
class GoCardlessListTaxRate extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_tax_rate';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of all tax rates.

Official GoCardless endpoint: GET /tax_rates.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/tax_rates';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
