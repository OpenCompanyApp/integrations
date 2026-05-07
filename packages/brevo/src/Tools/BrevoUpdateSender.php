<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update a sender.
 */
class BrevoUpdateSender extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_sender';

    protected string $toolDescription = 'Update a sender.';

    protected string $method = 'PUT';

    protected string $path = '/senders/{sender_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'sender_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Sender ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'sender_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
