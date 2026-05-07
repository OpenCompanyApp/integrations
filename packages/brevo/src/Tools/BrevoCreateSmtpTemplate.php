<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create an SMTP template.
 */
class BrevoCreateSmtpTemplate extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_smtp_template';

    protected string $toolDescription = 'Create an SMTP template.';

    protected string $method = 'POST';

    protected string $path = '/smtp/templates';

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
