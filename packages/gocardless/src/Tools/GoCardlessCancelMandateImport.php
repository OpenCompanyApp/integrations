<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Cancel a mandate import.
 *
 * Maps to the official GoCardless endpoint POST /mandate_imports/{mandate_import_id}/actions/cancel.
 */
class GoCardlessCancelMandateImport extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_cancel_mandate_import';
    protected const DESCRIPTION = 'Cancels the mandate import, which aborts the import process and stops the mandates being set up in GoCardless. Once the import has been cancelled, it can no longer have entries added to it. Mandate imports which have already been submitted or processed cannot be cancelled.

Official GoCardless endpoint: POST /mandate_imports/{mandate_import_id}/actions/cancel.';
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
    protected const PATH = '/mandate_imports/{mandate_import_id}/actions/cancel';
    protected const PATH_PARAMS = [
        'mandate_import_id' => 'mandate_import_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
