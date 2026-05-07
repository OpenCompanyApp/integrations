<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create a sender domain.
 */
class BrevoCreateSenderDomain extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_sender_domain';

    protected string $toolDescription = 'Create a sender domain.';

    protected string $method = 'POST';

    protected string $path = '/senders/domains';

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
