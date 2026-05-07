<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete a scheduled transactional email.
 */
class BrevoDeleteTransactionalEmail extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_transactional_email';

    protected string $toolDescription = 'Delete a scheduled transactional email.';

    protected string $method = 'DELETE';

    protected string $path = '/smtp/email/{identifier}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'identifier' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Scheduled email identifier.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'identifier',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
