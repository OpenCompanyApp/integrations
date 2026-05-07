<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get an outbound payment.
 *
 * Maps to the official GoCardless endpoint GET /outbound_payments/{outbound_payment_id}.
 */
class GoCardlessGetOutboundPayments extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_outbound_payments';
    protected const DESCRIPTION = 'Fetches an outbound_payment by ID

Official GoCardless endpoint: GET /outbound_payments/{outbound_payment_id}.';
    protected const PARAMETERS = [
        'outbound_payment_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The outbound payment id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/outbound_payments/{outbound_payment_id}';
    protected const PATH_PARAMS = [
        'outbound_payment_id' => 'outbound_payment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
