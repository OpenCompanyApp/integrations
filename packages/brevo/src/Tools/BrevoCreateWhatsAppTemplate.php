<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create a WhatsApp template.
 */
class BrevoCreateWhatsAppTemplate extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_whatsapp_template';

    protected string $toolDescription = 'Create a WhatsApp template.';

    protected string $method = 'POST';

    protected string $path = '/whatsappCampaigns/template';

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
