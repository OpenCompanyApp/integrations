<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Change currency.
 *
 * Maps to the official GoCardless endpoint POST /billing_requests/{billing_request_id}/actions/choose_currency.
 */
class GoCardlessChooseCurrencyBillingRequest extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_choose_currency_billing_request';
    protected const DESCRIPTION = 'This will allow for the updating of the currency and subsequently the scheme if needed for a Billing Request. This will only be available for mandate only flows which do not have the lock_currency flag set to true on the Billing Request Flow. It will also not support any request which has a payments request.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/choose_currency.';
    protected const PARAMETERS = [
        'billing_request_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The billing request id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GoCardless OpenAPI schema.',
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/billing_requests/{billing_request_id}/actions/choose_currency';
    protected const PATH_PARAMS = [
        'billing_request_id' => 'billing_request_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
