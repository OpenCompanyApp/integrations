<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Subscribe the app to WhatsApp Business Account webhook events.
 */
class WhatsAppSubscribeApp extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_subscribe_app';
    }

    public function description(): string
    {
        return 'Subscribe the configured app to WhatsApp Business Account webhook events.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Subscribe the app.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->subscribeApp());
    }
}
