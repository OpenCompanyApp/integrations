<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a Chargebee attached item by ID.
 */
class ChargebeeGetAttachedItem extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/attached_items/{id}';

    protected string $toolName = 'chargebee_get_attached_item';

    protected string $toolDescription = 'Retrieve a Chargebee attached item by ID.';
}
