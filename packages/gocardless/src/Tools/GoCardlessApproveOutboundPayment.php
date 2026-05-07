<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Approve an outbound payment.
 *
 * Maps to the official GoCardless endpoint POST /outbound_payments/{outbound_payment_id}/actions/approve.
 */
class GoCardlessApproveOutboundPayment extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_approve_outbound_payment';
    protected const DESCRIPTION = 'Approves an outbound payment. Only outbound payments with the “pending_approval” status can be approved.

Official GoCardless endpoint: POST /outbound_payments/{outbound_payment_id}/actions/approve.';
    protected const PARAMETERS = [
        'outbound_payment_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The outbound payment id',
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
    protected const PATH = '/outbound_payments/{outbound_payment_id}/actions/approve';
    protected const PATH_PARAMS = [
        'outbound_payment_id' => 'outbound_payment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
