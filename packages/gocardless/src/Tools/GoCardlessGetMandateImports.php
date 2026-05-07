<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a mandate import.
 *
 * Maps to the official GoCardless endpoint GET /mandate_imports/{mandate_import_id}.
 */
class GoCardlessGetMandateImports extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_mandate_imports';
    protected const DESCRIPTION = 'Returns a single mandate import.

Official GoCardless endpoint: GET /mandate_imports/{mandate_import_id}.';
    protected const PARAMETERS = [
        'mandate_import_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The mandate import id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/mandate_imports/{mandate_import_id}';
    protected const PATH_PARAMS = [
        'mandate_import_id' => 'mandate_import_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
