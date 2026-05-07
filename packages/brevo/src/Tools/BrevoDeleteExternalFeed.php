<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete an external feed.
 */
class BrevoDeleteExternalFeed extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_external_feed';

    protected string $toolDescription = 'Delete an external feed.';

    protected string $method = 'DELETE';

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
