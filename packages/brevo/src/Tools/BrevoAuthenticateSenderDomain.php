<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Authenticate a sender domain.
 */
class BrevoAuthenticateSenderDomain extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_authenticate_sender_domain';

    protected string $toolDescription = 'Authenticate a sender domain.';

    protected string $method = 'PUT';

    protected string $path = '/senders/domains/{domain_name}/authenticate';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain_name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Domain name.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'domain_name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
