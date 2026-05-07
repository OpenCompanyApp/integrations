<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete an SMTP template.
 */
class BrevoDeleteSmtpTemplate extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_smtp_template';

    protected string $toolDescription = 'Delete an SMTP template.';

    protected string $method = 'DELETE';

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
