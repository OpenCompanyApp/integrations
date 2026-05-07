<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Validate whether supplied phone numbers are reachable WhatsApp contacts.
 */
class WhatsAppCheckContacts extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_check_contacts';
    }

    public function description(): string
    {
        return 'Validate one or more phone numbers through the WhatsApp Cloud API contacts endpoint.';
    }

    public function parameters(): array
    {
        return [
            'contacts' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Phone numbers in international format without +.'],
        ];
    }

    /**
     * Validate WhatsApp contacts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(function () use ($args): array {
            $contacts = $this->arrayArg($args, 'contacts');
            if ($contacts === []) {
                throw new \InvalidArgumentException('contacts is required.');
            }

            return $this->service->checkContacts(array_map('strval', $contacts));
        });
    }
}
