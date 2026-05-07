<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Confirm the payer details.
 *
 * Maps to the official GoCardless endpoint POST /billing_requests/{billing_request_id}/actions/confirm_payer_details.
 */
class GoCardlessConfirmPayerDetailsBillingRequest extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_confirm_payer_details_billing_request';
    protected const DESCRIPTION = 'This is needed when you have a mandate request. As a scheme compliance rule we are required to allow the payer to crosscheck the details entered by them and confirm it.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/confirm_payer_details.';
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
    protected const PATH = '/billing_requests/{billing_request_id}/actions/confirm_payer_details';
    protected const PATH_PARAMS = [
        'billing_request_id' => 'billing_request_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
