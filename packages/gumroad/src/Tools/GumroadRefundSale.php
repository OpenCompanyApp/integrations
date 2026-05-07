<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Refund a sale.
 */
class GumroadRefundSale extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_refund_sale';

    protected string $toolDescription = 'Refund a sale.';

    protected string $method = 'PUT';

    protected string $path = '/sales/{sale_id}/refund';

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
        'description' => 'Optional refund body.',
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
