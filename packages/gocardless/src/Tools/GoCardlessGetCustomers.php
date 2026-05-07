<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single customer.
 *
 * Maps to the official GoCardless endpoint GET /customers/{customer_id}.
 */
class GoCardlessGetCustomers extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_customers';
    protected const DESCRIPTION = 'Retrieves the details of an existing customer.

Official GoCardless endpoint: GET /customers/{customer_id}.';
    protected const PARAMETERS = [
        'customer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The customer id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers/{customer_id}';
    protected const PATH_PARAMS = [
        'customer_id' => 'customer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
