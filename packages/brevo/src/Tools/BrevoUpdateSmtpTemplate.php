<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update an SMTP template.
 */
class BrevoUpdateSmtpTemplate extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_smtp_template';

    protected string $toolDescription = 'Update an SMTP template.';

    protected string $method = 'PUT';

    protected string $path = '/smtp/templates/{template_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'template_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Template ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'template_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
