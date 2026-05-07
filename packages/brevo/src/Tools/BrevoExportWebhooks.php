<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Export webhook logs.
 */
class BrevoExportWebhooks extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_export_webhooks';

    protected string $toolDescription = 'Export webhook logs.';

    protected string $method = 'POST';

    protected string $path = '/webhooks/export';

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
