<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Collect bank account details.
 *
 * Maps to the official GoCardless endpoint POST /billing_requests/{billing_request_id}/actions/collect_bank_account.
 */
class GoCardlessCollectBankAccountBillingRequest extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_collect_bank_account_billing_request';
    protected const DESCRIPTION = 'Collect bank account details

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/collect_bank_account.';
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
    protected const PATH = '/billing_requests/{billing_request_id}/actions/collect_bank_account';
    protected const PATH_PARAMS = [
        'billing_request_id' => 'billing_request_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
