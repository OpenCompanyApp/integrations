<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete a sender.
 */
class BrevoDeleteSender extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_sender';

    protected string $toolDescription = 'Delete a sender.';

    protected string $method = 'DELETE';

    protected string $path = '/senders/{sender_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'sender_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Sender ID.',
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
];
}
