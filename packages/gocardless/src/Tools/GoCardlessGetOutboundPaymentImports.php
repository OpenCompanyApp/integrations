<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get an outbound payment import.
 *
 * Maps to the official GoCardless endpoint GET /outbound_payment_imports/{outbound_payment_import_id}.
 */
class GoCardlessGetOutboundPaymentImports extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_outbound_payment_imports';
    protected const DESCRIPTION = 'Returns a single outbound payment import.

Official GoCardless endpoint: GET /outbound_payment_imports/{outbound_payment_import_id}.';
    protected const PARAMETERS = [
        'outbound_payment_import_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The outbound payment import id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/outbound_payment_imports/{outbound_payment_import_id}';
    protected const PATH_PARAMS = [
        'outbound_payment_import_id' => 'outbound_payment_import_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
