<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Notify the customer.
 *
 * Maps to the official GoCardless endpoint POST /billing_requests/{billing_request_id}/actions/notify.
 */
class GoCardlessNotifyBillingRequest extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_notify_billing_request';
    protected const DESCRIPTION = 'Notifies the customer linked to the billing request, asking them to authorise it. Currently, the customer can only be notified by email. This endpoint is currently supported only for Instant Bank Pay Billing Requests.

Official GoCardless endpoint: POST /billing_requests/{billing_request_id}/actions/notify.';
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
    protected const PATH = '/billing_requests/{billing_request_id}/actions/notify';
    protected const PATH_PARAMS = [
        'billing_request_id' => 'billing_request_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
