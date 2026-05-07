<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a new mandate import.
 *
 * Maps to the official GoCardless endpoint POST /mandate_imports.
 */
class GoCardlessCreateMandateImport extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_mandate_import';
    protected const DESCRIPTION = 'Mandate imports are first created, before mandates are added one-at-a-time, so this endpoint merely signals the start of the import process. Once you\'ve finished adding entries to an import, you should [submit](#mandate-imports-submit-a-mandate-import) it.

Official GoCardless endpoint: POST /mandate_imports.';
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
    protected const PATH = '/mandate_imports';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
