<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Unsubscribe the app from WhatsApp Business Account webhook events.
 */
class WhatsAppUnsubscribeApp extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_unsubscribe_app';
    }

    public function description(): string
    {
        return 'Unsubscribe the configured app from WhatsApp Business Account webhook events.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Unsubscribe the app.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->unsubscribeApp());
    }
}
