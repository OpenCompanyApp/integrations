<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete an eCommerce product.
 */
class BrevoDeleteProduct extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_product';

    protected string $toolDescription = 'Delete an eCommerce product.';

    protected string $method = 'DELETE';

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
