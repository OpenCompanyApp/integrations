<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Export contacts from Brevo.
 */
class BrevoExportContacts extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_export_contacts';

    protected string $toolDescription = 'Export contacts from Brevo.';

    protected string $method = 'POST';

    protected string $path = '/contacts/export';

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
