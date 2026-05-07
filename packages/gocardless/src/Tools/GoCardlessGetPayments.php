<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single payment.
 *
 * Maps to the official GoCardless endpoint GET /payments/{payment_id}.
 */
class GoCardlessGetPayments extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_payments';
    protected const DESCRIPTION = 'Retrieves the details of a single existing payment.

Official GoCardless endpoint: GET /payments/{payment_id}.';
    protected const PARAMETERS = [
        'payment_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payment id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payments/{payment_id}';
    protected const PATH_PARAMS = [
        'payment_id' => 'payment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
