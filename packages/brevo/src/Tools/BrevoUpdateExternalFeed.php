<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update an external feed.
 */
class BrevoUpdateExternalFeed extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_external_feed';

    protected string $toolDescription = 'Update an external feed.';

    protected string $method = 'PUT';

    protected string $path = '/feeds/{uuid}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'uuid' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Feed UUID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'uuid',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
