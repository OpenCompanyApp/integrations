<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one product Image.
 */
class ShopifyGetProductImage extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_product_image';

    protected string $toolDescription = 'Get one product Image.';

    protected string $method = 'GET';

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
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
    'image_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}