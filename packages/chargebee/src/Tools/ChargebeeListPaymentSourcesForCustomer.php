<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * List payment sources for a customer.
 */
class ChargebeeListPaymentSourcesForCustomer extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'Customer ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
    ];

    protected array $required = ['customer_id'];

    protected array $queryParams = ['limit', 'offset'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/customers/{customer_id}/payment_sources';

    protected string $toolName = 'chargebee_list_payment_sources_for_customer';

    protected string $toolDescription = 'List payment sources for a customer.';
}
