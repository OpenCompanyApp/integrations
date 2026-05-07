<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Funds availability.
 *
 * Maps to the official GoCardless endpoint GET /funds_availability/{mandate_id}.
 */
class GoCardlessGetFundsAvailability extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_funds_availability';
    protected const DESCRIPTION = 'Checks if the payer\'s current balance is sufficient to cover the amount the merchant wants to charge within the consent parameters defined on the mandate.

Official GoCardless endpoint: GET /funds_availability/{mandate_id}.';
    protected const PARAMETERS = [
        'mandate_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The mandate id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/funds_availability/{mandate_id}';
    protected const PATH_PARAMS = [
        'mandate_id' => 'mandate_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
