<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update an eCommerce category.
 */
class BrevoUpdateCategory extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_category';

    protected string $toolDescription = 'Update an eCommerce category.';

    protected string $method = 'PATCH';

    protected string $path = '/categories/{category_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'category_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Category ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
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
    'payload',
];
}
