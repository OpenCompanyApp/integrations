<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Register a WhatsApp phone number for Cloud API use.
 */
class WhatsAppRegisterPhoneNumber extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_register_phone_number';
    }

    public function description(): string
    {
        return 'Register a WhatsApp phone number for Cloud API use with a two-step verification PIN.';
    }

    public function parameters(): array
    {
        return [
            'pin' => ['type' => 'string', 'required' => true, 'description' => 'Two-step verification PIN.'],
            'phone_number_id' => ['type' => 'string', 'description' => 'Optional phone number ID. Defaults to configured phone number.'],
        ];
    }

    /**
     * Register a phone number.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->registerPhoneNumber(
            $this->requiredString($args, 'pin'),
            $this->string($args, 'phone_number_id') ?: null,
        ));
    }
}
