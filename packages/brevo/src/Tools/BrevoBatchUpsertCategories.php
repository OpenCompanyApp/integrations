<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Batch upsert eCommerce categories.
 */
class BrevoBatchUpsertCategories extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_batch_upsert_categories';

    protected string $toolDescription = 'Batch upsert eCommerce categories.';

    protected string $method = 'POST';

    protected string $path = '/categories/batch';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
