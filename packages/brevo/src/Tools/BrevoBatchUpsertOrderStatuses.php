<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Batch upsert eCommerce order statuses.
 */
class BrevoBatchUpsertOrderStatuses extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_batch_upsert_order_statuses';

    protected string $toolDescription = 'Batch upsert eCommerce order statuses.';

    protected string $method = 'POST';

    protected string $path = '/orders/status/batch';

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
