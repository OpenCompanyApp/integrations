<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get a transactional email log by UUID.
 */
class BrevoGetTransactionalEmail extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_transactional_email';

    protected string $toolDescription = 'Get a transactional email log by UUID.';

    protected string $method = 'GET';

    protected string $path = '/smtp/emails/{uuid}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'uuid' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Transactional email UUID.',
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
