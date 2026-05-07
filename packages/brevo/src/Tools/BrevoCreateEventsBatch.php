<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create custom events in batch.
 */
class BrevoCreateEventsBatch extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_events_batch';

    protected string $toolDescription = 'Create custom events in batch.';

    protected string $method = 'POST';

    protected string $path = '/events/batch';

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
