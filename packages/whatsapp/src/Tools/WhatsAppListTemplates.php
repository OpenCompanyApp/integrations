<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List approved message templates for the WhatsApp Business Account.
 *
 * Returns template names, statuses, languages, categories and component
 * definitions. Templates are required for initiating new conversations
 * outside the 24-hour customer-service window.
 *
 * @see https://developers.facebook.com/docs/whatsapp/business-management-api/message-templates
 */
class WhatsAppListTemplates implements Tool
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
        return 'whatsapp_list_templates';
    }

    /**
     * Human-readable description shown to AI agents and users.
     */
    public function description(): string
    {
        return 'List approved WhatsApp message templates. Templates are required to initiate new conversations outside the 24-hour service window.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of templates to return (default: 100).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination.'],
            'status' => ['type' => 'string', 'description' => 'Optional template status filter such as APPROVED, PENDING, or REJECTED.'],
            'name' => ['type' => 'string', 'description' => 'Optional template name filter.'],
        ];
    }

    /**
     * Execute the tool and list templates from the WABA API.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->hasAccessToken()) {
                return ToolResult::error('WhatsApp access token is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $result = $this->service->listTemplates($limit, $args['after'] ?? null, $args['status'] ?? null, $args['name'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
