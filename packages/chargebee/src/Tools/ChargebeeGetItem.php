<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a Chargebee item by ID.
 */
class ChargebeeGetItem extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/items/{id}';

    protected string $toolName = 'chargebee_get_item';

    protected string $toolDescription = 'Retrieve a Chargebee item by ID.';
}
