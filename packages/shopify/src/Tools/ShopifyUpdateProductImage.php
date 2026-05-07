<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a product Image.
 */
class ShopifyUpdateProductImage extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_product_image';

    protected string $toolDescription = 'Update a product Image.';

    protected string $method = 'PUT';

    protected string $path = '/products/{product_id}/images/{image_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify product ID.',
    ],
    'image_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Image ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented product Image update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
    'image_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}