<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Submit a mandate import.
 *
 * Maps to the official GoCardless endpoint POST /mandate_imports/{mandate_import_id}/actions/submit.
 */
class GoCardlessSubmitMandateImport extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_submit_mandate_import';
    protected const DESCRIPTION = 'Submit a mandate import

Official GoCardless endpoint: POST /mandate_imports/{mandate_import_id}/actions/submit.';
    protected const PARAMETERS = [
        'mandate_import_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The mandate import id',
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
    protected const PATH = '/mandate_imports/{mandate_import_id}/actions/submit';
    protected const PATH_PARAMS = [
        'mandate_import_id' => 'mandate_import_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
