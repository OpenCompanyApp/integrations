<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single creditor.
 *
 * Maps to the official GoCardless endpoint GET /creditors/{creditor_id}.
 */
class GoCardlessGetCreditors extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_creditors';
    protected const DESCRIPTION = 'Retrieves the details of an existing creditor.

Official GoCardless endpoint: GET /creditors/{creditor_id}.';
    protected const PARAMETERS = [
        'creditor_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The creditor id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/creditors/{creditor_id}';
    protected const PATH_PARAMS = [
        'creditor_id' => 'creditor_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
