<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Verify a WhatsApp phone-number registration code.
 */
class WhatsAppVerifyCode extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_verify_code';
    }

    public function description(): string
    {
        return 'Verify a WhatsApp phone-number registration code.';
    }

    public function parameters(): array
    {
        return [
            'code' => ['type' => 'string', 'required' => true, 'description' => 'Verification code from Meta.'],
            'phone_number_id' => ['type' => 'string', 'description' => 'Optional phone number ID. Defaults to configured phone number.'],
        ];
    }

    /**
     * Verify a phone-number code.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->verifyCode(
            $this->requiredString($args, 'code'),
            $this->string($args, 'phone_number_id') ?: null,
        ));
    }
}
