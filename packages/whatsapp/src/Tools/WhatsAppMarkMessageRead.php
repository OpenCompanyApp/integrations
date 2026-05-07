<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Mark an inbound WhatsApp message as read.
 */
class WhatsAppMarkMessageRead extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_mark_message_read';
    }

    public function description(): string
    {
        return 'Mark an inbound WhatsApp message as read using its message ID.';
    }

    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbound WhatsApp message ID.'],
        ];
    }

    /**
     * Mark a message as read.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->markMessageRead($this->requiredString($args, 'message_id')));
    }
}
