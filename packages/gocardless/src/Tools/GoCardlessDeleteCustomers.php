<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Remove a customer.
 *
 * Maps to the official GoCardless endpoint DELETE /customers/{customer_id}.
 */
class GoCardlessDeleteCustomers extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_delete_customers';
    protected const DESCRIPTION = 'Removed customers will not appear in search results or lists of customers (in our API or exports), and it will not be possible to load an individually removed customer by ID. <p class="restricted-notice"><strong>The action of removing a customer cannot be reversed, so please use with care.</strong></p>

Official GoCardless endpoint: DELETE /customers/{customer_id}.';
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
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/customers/{customer_id}';
    protected const PATH_PARAMS = [
        'customer_id' => 'customer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
