<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get an eCommerce product.
 */
class BrevoGetProduct extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_product';

    protected string $toolDescription = 'Get an eCommerce product.';

    protected string $method = 'GET';

    protected string $path = '/products/{product_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Product ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
