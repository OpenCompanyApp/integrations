<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Add a mandate import entry.
 *
 * Maps to the official GoCardless endpoint POST /mandate_import_entries.
 */
class GoCardlessCreateMandateImportEntry extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_mandate_import_entry';
    protected const DESCRIPTION = 'For an existing [mandate import](#core-endpoints-mandate-imports), this endpoint can be used to add individual mandates to be imported into GoCardless. You can add no more than 30,000 rows to a single mandate import. If you attempt to go over this limit, the API will return a `record_limit_exceeded` error.

Official GoCardless endpoint: POST /mandate_import_entries.';
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
    protected const PATH = '/mandate_import_entries';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
