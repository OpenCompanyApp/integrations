<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List contacts associated with the WhatsApp Business phone number.
 *
 * Returns WhatsApp IDs and profile names for each contact.
 *
 * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/contacts
 */
class WhatsAppListContacts implements Tool
{
    /**
     * Create a new WhatsAppListContacts tool instance.
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
        return 'List WhatsApp contacts for the business phone number. Returns WhatsApp IDs and profile names.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 100).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
        ];
    }

    /**
     * Execute the tool — list contacts from the API.
     *
     * @param  array{limit?: int, after?: string}  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WhatsApp integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $result = $this->service->listContacts($limit, $args['after'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
