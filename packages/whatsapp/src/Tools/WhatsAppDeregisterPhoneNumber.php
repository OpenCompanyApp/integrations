<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Deregister a WhatsApp phone number from Cloud API use.
 */
class WhatsAppDeregisterPhoneNumber extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_deregister_phone_number';
    }

    public function description(): string
    {
        return 'Deregister a WhatsApp phone number from Cloud API use.';
    }

    public function parameters(): array
    {
        return [
            'phone_number_id' => ['type' => 'string', 'description' => 'Optional phone number ID. Defaults to configured phone number.'],
        ];
    }

    /**
     * Deregister a phone number.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deregisterPhoneNumber($this->string($args, 'phone_number_id') ?: null));
    }
}
