<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a payment.
 *
 * Maps to the official GoCardless endpoint POST /payments.
 */
class GoCardlessCreatePayment extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_payment';
    protected const DESCRIPTION = '<a name="mandate_is_inactive"></a>Creates a new payment object. This fails with a `mandate_is_inactive` error if the linked [mandate](#core-endpoints-mandates) is cancelled or has failed. Payments can be created against mandates with status of: `pending_customer_approval`, `pending_submission`, `submitted`, and `active`.

Official GoCardless endpoint: POST /payments.';
    protected const PARAMETERS = [
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
    protected const PATH = '/payments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
