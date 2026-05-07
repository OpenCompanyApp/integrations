<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a Chargebee transaction by ID.
 */
class ChargebeeGetTransaction extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/transactions/{id}';

    protected string $toolName = 'chargebee_get_transaction';

    protected string $toolDescription = 'Retrieve a Chargebee transaction by ID.';
}
