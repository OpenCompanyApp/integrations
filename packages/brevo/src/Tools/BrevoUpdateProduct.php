<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update an eCommerce product.
 */
class BrevoUpdateProduct extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_product';

    protected string $toolDescription = 'Update an eCommerce product.';

    protected string $method = 'PATCH';

    protected string $path = '/products/{product_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Product ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
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
    'payload',
];
}
