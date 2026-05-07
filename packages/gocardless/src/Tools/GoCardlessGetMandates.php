<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single mandate.
 *
 * Maps to the official GoCardless endpoint GET /mandates/{mandate_id}.
 */
class GoCardlessGetMandates extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_mandates';
    protected const DESCRIPTION = 'Retrieves the details of an existing mandate.

Official GoCardless endpoint: GET /mandates/{mandate_id}.';
    protected const PARAMETERS = [
        'mandate_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The mandate id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/mandates/{mandate_id}';
    protected const PATH_PARAMS = [
        'mandate_id' => 'mandate_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
