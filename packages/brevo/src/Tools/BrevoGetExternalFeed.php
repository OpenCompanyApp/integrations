<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get an external feed.
 */
class BrevoGetExternalFeed extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_external_feed';

    protected string $toolDescription = 'Get an external feed.';

    protected string $method = 'GET';

    protected string $path = '/feeds/{uuid}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'uuid' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Feed UUID.',
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
];
}
