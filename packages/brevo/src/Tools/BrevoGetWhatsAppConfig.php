<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get WhatsApp configuration.
 */
class BrevoGetWhatsAppConfig extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_whatsapp_config';

    protected string $toolDescription = 'Get WhatsApp configuration.';

    protected string $method = 'GET';

    protected string $path = '/whatsappCampaigns/config';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
