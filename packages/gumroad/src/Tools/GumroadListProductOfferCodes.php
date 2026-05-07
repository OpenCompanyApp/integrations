<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * List offer codes for a product.
 */
class GumroadListProductOfferCodes extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_list_product_offer_codes';

    protected string $toolDescription = 'List offer codes for a product.';

    protected string $method = 'GET';

    protected string $path = '/products/{product_id}/offer_codes';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Gumroad product ID.',
    ],
    'page' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number for paginated Gumroad endpoints.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Gumroad query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'page',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
