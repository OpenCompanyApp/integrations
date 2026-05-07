<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Send a WhatsApp template for approval.
 */
class BrevoSendWhatsAppTemplateForApproval extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_send_whatsapp_template_for_approval';

    protected string $toolDescription = 'Send a WhatsApp template for approval.';

    protected string $method = 'POST';

    protected string $path = '/whatsappCampaigns/template/approval/{template_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'template_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Template ID.',
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
];
}
