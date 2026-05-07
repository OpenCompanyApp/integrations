<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a refund.
 *
 * Maps to the official GoCardless endpoint POST /refunds.
 */
class GoCardlessCreateRefund extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_refund';
    protected const DESCRIPTION = 'Create a refund

Official GoCardless endpoint: POST /refunds.';
    protected const PARAMETERS = [
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
    protected const PATH = '/refunds';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
