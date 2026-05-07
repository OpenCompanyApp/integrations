<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Retry a webhook.
 *
 * Maps to the official GoCardless endpoint POST /webhooks/{webhook_id}/actions/retry.
 */
class GoCardlessRetryWebhook extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_retry_webhook';
    protected const DESCRIPTION = 'Requests for a previous webhook to be sent again

Official GoCardless endpoint: POST /webhooks/{webhook_id}/actions/retry.';
    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The webhook id',
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
    protected const PATH = '/webhooks/{webhook_id}/actions/retry';
    protected const PATH_PARAMS = [
        'webhook_id' => 'webhook_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
