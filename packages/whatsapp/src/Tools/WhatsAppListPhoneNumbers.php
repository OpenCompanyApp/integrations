<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List phone numbers attached to the configured WhatsApp Business Account.
 */
class WhatsAppListPhoneNumbers extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_list_phone_numbers';
    }

    public function description(): string
    {
        return 'List phone numbers attached to the configured WhatsApp Business Account.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of phone numbers to return.'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        ];
    }

    /**
     * List WhatsApp phone numbers.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listPhoneNumbers(
            $this->integer($args, 'limit', 100),
            $this->string($args, 'after') ?: null,
        ));
    }
}
