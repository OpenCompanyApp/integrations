<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a payout.
 *
 * Maps to the official GoCardless endpoint PUT /payouts/{payout_id}.
 */
class GoCardlessUpdatePayouts extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_payouts';
    protected const DESCRIPTION = 'Updates a payout object. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /payouts/{payout_id}.';
    protected const PARAMETERS = [
        'payout_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payout id',
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
    protected const PATH = '/payouts/{payout_id}';
    protected const PATH_PARAMS = [
        'payout_id' => 'payout_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
