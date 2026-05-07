<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Compatibility tool for checking WhatsApp contacts.
*
 * The Cloud API exposes contact validation as POST /contacts. This legacy
 * slug now validates the supplied phone numbers instead of calling a
 * nonexistent contacts listing endpoint.
 *
 * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/contacts
 */
class WhatsAppListContacts implements Tool
{
    /**
     * @param  WhatsAppService  $service  WhatsApp API client.
     */
    public function __construct(
        private WhatsAppService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'whatsapp_list_contacts';
    }

    /**
     * Human-readable description shown to AI agents and users.
     */
    public function description(): string
    {
        return 'Validate WhatsApp contacts for the configured business phone number. Legacy slug for check_contacts.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'contacts' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Phone numbers in international format without +.'],
        ];
    }

    /**
     * Execute the tool and validate contacts through the API.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('WhatsApp integration is not configured.');
            }

            $contacts = $args['contacts'] ?? [];
            if (is_string($contacts)) {
                $contacts = array_values(array_filter(array_map('trim', explode(',', $contacts))));
            }

            if (! is_array($contacts) || $contacts === []) {
                return ToolResult::error('contacts is required.');
            }

            $result = $this->service->checkContacts($contacts);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
