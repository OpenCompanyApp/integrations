<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get an eCommerce category.
 */
class BrevoGetCategory extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_category';

    protected string $toolDescription = 'Get an eCommerce category.';

    protected string $method = 'GET';

    protected string $path = '/categories/{category_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'category_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Category ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'category_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
