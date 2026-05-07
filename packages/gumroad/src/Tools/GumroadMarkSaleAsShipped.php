<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Mark a physical sale as shipped.
 */
class GumroadMarkSaleAsShipped extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_mark_sale_as_shipped';

    protected string $toolDescription = 'Mark a physical sale as shipped.';

    protected string $method = 'PUT';

    protected string $path = '/sales/{sale_id}/mark_as_shipped';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'sale_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Gumroad sale ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Optional shipping body such as tracking information.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'sale_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
