<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a payment source by ID.
 */
class ChargebeeGetPaymentSource extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = ['limit', 'offset'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/payment_sources/{id}';

    protected string $toolName = 'chargebee_get_payment_source';

    protected string $toolDescription = 'Retrieve a payment source by ID.';
}
