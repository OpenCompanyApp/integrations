<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Import contacts into Brevo.
 */
class BrevoImportContacts extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_import_contacts';

    protected string $toolDescription = 'Import contacts into Brevo.';

    protected string $method = 'POST';

    protected string $path = '/contacts/import';

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
