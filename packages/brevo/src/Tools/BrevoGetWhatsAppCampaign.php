<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get a WhatsApp campaign.
 */
class BrevoGetWhatsAppCampaign extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_whatsapp_campaign';

    protected string $toolDescription = 'Get a WhatsApp campaign.';

    protected string $method = 'GET';

    protected string $path = '/whatsappCampaigns/{campaign_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'campaign_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Campaign ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'campaign_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
