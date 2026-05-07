<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Request a registration verification code for a WhatsApp phone number.
 */
class WhatsAppRequestVerificationCode extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_request_verification_code';
    }

    public function description(): string
    {
        return 'Request a WhatsApp phone-number verification code by SMS or voice.';
    }

    public function parameters(): array
    {
        return [
            'code_method' => ['type' => 'string', 'required' => true, 'enum' => ['SMS', 'VOICE'], 'description' => 'Delivery method.'],
            'language' => ['type' => 'string', 'description' => 'Language code for the verification message. Defaults to en.'],
            'phone_number_id' => ['type' => 'string', 'description' => 'Optional phone number ID. Defaults to configured phone number.'],
        ];
    }

    /**
     * Request a verification code.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->requestVerificationCode(
            $this->requiredString($args, 'code_method'),
            $this->string($args, 'language', 'en') ?: 'en',
            $this->string($args, 'phone_number_id') ?: null,
        ));
    }
}
