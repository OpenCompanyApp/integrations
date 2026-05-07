<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Send a test for an SMTP template.
 */
class BrevoSendSmtpTemplateTest extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_send_smtp_template_test';

    protected string $toolDescription = 'Send a test for an SMTP template.';

    protected string $method = 'POST';

    protected string $path = '/smtp/templates/{template_id}/sendTest';

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
