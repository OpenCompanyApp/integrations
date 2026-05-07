<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single tax rate.
 *
 * Maps to the official GoCardless endpoint GET /tax_rates/{tax_rate_id}.
 */
class GoCardlessGetTaxRates extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_tax_rates';
    protected const DESCRIPTION = 'Retrieves the details of a tax rate.

Official GoCardless endpoint: GET /tax_rates/{tax_rate_id}.';
    protected const PARAMETERS = [
        'tax_rate_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The tax rate id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/tax_rates/{tax_rate_id}';
    protected const PATH_PARAMS = [
        'tax_rate_id' => 'tax_rate_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
