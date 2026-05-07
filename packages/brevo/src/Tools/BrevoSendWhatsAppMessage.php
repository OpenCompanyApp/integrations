<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Send a transactional WhatsApp message.
 */
class BrevoSendWhatsAppMessage extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_send_whatsapp_message';

    protected string $toolDescription = 'Send a transactional WhatsApp message.';

    protected string $method = 'POST';

    protected string $path = '/whatsapp/sendMessage';

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
