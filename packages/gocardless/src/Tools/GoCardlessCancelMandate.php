<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Cancel a mandate.
 *
 * Maps to the official GoCardless endpoint POST /mandates/{mandate_id}/actions/cancel.
 */
class GoCardlessCancelMandate extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_cancel_mandate';
    protected const DESCRIPTION = 'Immediately cancels a mandate and all associated cancellable payments. Any metadata supplied to this endpoint will be stored on the mandate cancellation event it causes. This will fail with a `cancellation_failed` error if the mandate is already cancelled.

Official GoCardless endpoint: POST /mandates/{mandate_id}/actions/cancel.';
    protected const PARAMETERS = [
        'mandate_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The mandate id',
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
    protected const PATH = '/mandates/{mandate_id}/actions/cancel';
    protected const PATH_PARAMS = [
        'mandate_id' => 'mandate_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
