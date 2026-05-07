<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a Chargebee order by ID.
 */
class ChargebeeGetOrder extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/orders/{id}';

    protected string $toolName = 'chargebee_get_order';

    protected string $toolDescription = 'Retrieve a Chargebee order by ID.';
}
