<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single refund.
 *
 * Maps to the official GoCardless endpoint GET /refunds/{refund_id}.
 */
class GoCardlessGetRefunds extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_refunds';
    protected const DESCRIPTION = 'Retrieves all details for a single refund

Official GoCardless endpoint: GET /refunds/{refund_id}.';
    protected const PARAMETERS = [
        'refund_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The refund id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/refunds/{refund_id}';
    protected const PATH_PARAMS = [
        'refund_id' => 'refund_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
