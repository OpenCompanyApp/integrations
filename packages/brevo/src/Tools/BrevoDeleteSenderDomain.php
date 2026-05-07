<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete a sender domain.
 */
class BrevoDeleteSenderDomain extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_sender_domain';

    protected string $toolDescription = 'Delete a sender domain.';

    protected string $method = 'DELETE';

    protected string $path = '/senders/domains/{domain_name}';

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
