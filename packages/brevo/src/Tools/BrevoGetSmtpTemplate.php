<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get an SMTP template.
 */
class BrevoGetSmtpTemplate extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_smtp_template';

    protected string $toolDescription = 'Get an SMTP template.';

    protected string $method = 'GET';

    protected string $path = '/smtp/templates/{template_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'template_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Template ID.',
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
];
}
