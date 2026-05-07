<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a customer.
 *
 * Maps to the official GoCardless endpoint PUT /customers/{customer_id}.
 */
class GoCardlessUpdateCustomers extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_customers';
    protected const DESCRIPTION = 'Updates a customer object. Supports all of the fields supported when creating a customer.

Official GoCardless endpoint: PUT /customers/{customer_id}.';
    protected const PARAMETERS = [
        'customer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The customer id',
        ],
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
    protected const METHOD = 'PUT';
    protected const PATH = '/customers/{customer_id}';
    protected const PATH_PARAMS = [
        'customer_id' => 'customer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
