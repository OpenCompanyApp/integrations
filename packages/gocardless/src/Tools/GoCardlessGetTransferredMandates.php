<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get updated customer bank details.
 *
 * Maps to the official GoCardless endpoint GET /transferred_mandates/{mandate_id}.
 */
class GoCardlessGetTransferredMandates extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_transferred_mandates';
    protected const DESCRIPTION = 'Returns new customer bank details for a mandate that\'s been recently transferred

Official GoCardless endpoint: GET /transferred_mandates/{mandate_id}.';
    protected const PARAMETERS = [
        'mandate_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The mandate id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/transferred_mandates/{mandate_id}';
    protected const PATH_PARAMS = [
        'mandate_id' => 'mandate_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
