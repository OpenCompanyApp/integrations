<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create a sender.
 */
class BrevoCreateSender extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_sender';

    protected string $toolDescription = 'Create a sender.';

    protected string $method = 'POST';

    protected string $path = '/senders';

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
