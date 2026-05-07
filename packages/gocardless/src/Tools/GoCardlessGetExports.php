<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single export.
 *
 * Maps to the official GoCardless endpoint GET /exports/{export_id}.
 */
class GoCardlessGetExports extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_exports';
    protected const DESCRIPTION = 'Returns a single export.

Official GoCardless endpoint: GET /exports/{export_id}.';
    protected const PARAMETERS = [
        'export_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The export id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/exports/{export_id}';
    protected const PATH_PARAMS = [
        'export_id' => 'export_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
