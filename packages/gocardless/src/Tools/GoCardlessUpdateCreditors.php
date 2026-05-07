<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a creditor.
 *
 * Maps to the official GoCardless endpoint PUT /creditors/{creditor_id}.
 */
class GoCardlessUpdateCreditors extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_creditors';
    protected const DESCRIPTION = 'Updates a creditor object. Supports all of the fields supported when creating a creditor.

Official GoCardless endpoint: PUT /creditors/{creditor_id}.';
    protected const PARAMETERS = [
        'creditor_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The creditor id',
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
    protected const PATH = '/creditors/{creditor_id}';
    protected const PATH_PARAMS = [
        'creditor_id' => 'creditor_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
