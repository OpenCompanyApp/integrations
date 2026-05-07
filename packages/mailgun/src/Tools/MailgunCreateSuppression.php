<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Compatibility alias for creating a bounce suppression.
 */
class MailgunCreateSuppression extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_create_suppression';

    protected string $toolDescription = 'Compatibility alias for creating a bounce suppression.';

    protected string $method = 'POST';

    protected string $path = '/{domain}/bounces';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Email address.',
    ],
    'code' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Bounce code.',
    ],
    'error' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Error text.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'address',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'address',
    'code',
    'error',
];
}
