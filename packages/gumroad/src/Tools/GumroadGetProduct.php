<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Get one Gumroad product by ID.
 */
class GumroadGetProduct extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_get_product';

    protected string $toolDescription = 'Get one Gumroad product by ID.';

    protected string $method = 'GET';

    protected string $path = '/products/{product_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Gumroad product ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
