<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Create an offer code for a product.
 */
class GumroadCreateProductOfferCode extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_create_product_offer_code';

    protected string $toolDescription = 'Create an offer code for a product.';

    protected string $method = 'POST';

    protected string $path = '/products/{product_id}/offer_codes';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Gumroad product ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Offer code body such as name, amount_off, max_purchase_count, and universal.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
