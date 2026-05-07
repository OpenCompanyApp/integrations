<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Cancel an outbound payment.
 *
 * Maps to the official GoCardless endpoint POST /outbound_payments/{outbound_payment_id}/actions/cancel.
 */
class GoCardlessCancelOutboundPayment extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_cancel_outbound_payment';
    protected const DESCRIPTION = 'Cancels an outbound payment. Only outbound payments with either `verifying`, `pending_approval`, or `scheduled` status can be cancelled. Once an outbound payment is `executing`, the money moving process has begun and cannot be reversed.

Official GoCardless endpoint: POST /outbound_payments/{outbound_payment_id}/actions/cancel.';
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
    protected const PATH = '/outbound_payments/{outbound_payment_id}/actions/cancel';
    protected const PATH_PARAMS = [
        'outbound_payment_id' => 'outbound_payment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
