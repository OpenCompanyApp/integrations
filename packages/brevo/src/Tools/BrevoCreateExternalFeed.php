<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create an external feed.
 */
class BrevoCreateExternalFeed extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_external_feed';

    protected string $toolDescription = 'Create an external feed.';

    protected string $method = 'POST';

    protected string $path = '/feeds';

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
