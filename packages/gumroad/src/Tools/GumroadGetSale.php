<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Get one sale by ID.
 */
class GumroadGetSale extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_get_sale';

    protected string $toolDescription = 'Get one sale by ID.';

    protected string $method = 'GET';

    protected string $path = '/sales/{sale_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'sale_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Gumroad sale ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'sale_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
