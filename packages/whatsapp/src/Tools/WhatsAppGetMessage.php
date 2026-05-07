<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a specific WhatsApp message by its ID.
 *
 * Returns the Graph object details available for the supplied message ID.
 *
 * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages
 */
class WhatsAppGetMessage implements Tool
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
        return 'whatsapp_get_message';
    }

    /**
     * Human-readable description shown to AI agents and users.
     */
    public function description(): string
    {
        return 'Retrieve a specific WhatsApp message or Graph object by ID with optional fields.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'The WhatsApp message ID or Graph object ID.'],
            'fields' => ['type' => 'string', 'description' => 'Optional comma-separated Graph fields to request.'],
        ];
    }

    /**
     * Execute the tool and fetch the message from the API.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->hasAccessToken()) {
                return ToolResult::error('WhatsApp access token is not configured.');
            }

            $messageId = $args['message_id'] ?? '';

            if (empty($messageId)) {
                return ToolResult::error('message_id is required.');
            }

            $result = $this->service->getMessage($messageId, $args['fields'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
