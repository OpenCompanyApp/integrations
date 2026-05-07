<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List apps subscribed to WhatsApp Business Account webhook events.
 */
class WhatsAppListSubscribedApps extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_list_subscribed_apps';
    }

    public function description(): string
    {
        return 'List apps subscribed to the configured WhatsApp Business Account webhook events.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List subscribed apps.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listSubscribedApps());
    }
}
