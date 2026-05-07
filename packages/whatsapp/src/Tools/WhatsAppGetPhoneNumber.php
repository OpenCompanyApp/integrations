<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve metadata for a WhatsApp Business phone number.
 */
class WhatsAppGetPhoneNumber extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_get_phone_number';
    }

    public function description(): string
    {
        return 'Get phone number metadata such as display number, verified name, quality rating, and throughput.';
    }

    public function parameters(): array
    {
        return [
            'phone_number_id' => ['type' => 'string', 'description' => 'Optional phone number ID. Defaults to the configured phone number.'],
        ];
    }

    /**
     * Get phone number metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getPhoneNumber($this->string($args, 'phone_number_id') ?: null));
    }
}
