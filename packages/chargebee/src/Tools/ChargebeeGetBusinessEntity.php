<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a Chargebee business entity by ID.
 */
class ChargebeeGetBusinessEntity extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/business_entities/{id}';

    protected string $toolName = 'chargebee_get_business_entity';

    protected string $toolDescription = 'Retrieve a Chargebee business entity by ID.';
}
