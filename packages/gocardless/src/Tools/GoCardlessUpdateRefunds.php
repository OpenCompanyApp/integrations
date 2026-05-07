<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a refund.
 *
 * Maps to the official GoCardless endpoint PUT /refunds/{refund_id}.
 */
class GoCardlessUpdateRefunds extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_refunds';
    protected const DESCRIPTION = 'Updates a refund object.

Official GoCardless endpoint: PUT /refunds/{refund_id}.';
    protected const PARAMETERS = [
        'refund_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The refund id',
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
    protected const METHOD = 'PUT';
    protected const PATH = '/refunds/{refund_id}';
    protected const PATH_PARAMS = [
        'refund_id' => 'refund_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
