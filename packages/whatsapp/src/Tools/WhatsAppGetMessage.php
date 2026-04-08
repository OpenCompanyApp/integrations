<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a specific WhatsApp message by its ID.
 *
 * Returns the message content, status, timestamps, and sender/recipient info.
 *
 * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#retrieve-messages
 */
class WhatsAppGetMessage implements Tool
{
    /**
     * Create a new WhatsAppGetMessage tool instance.
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
        return 'Retrieve a specific WhatsApp message by its ID. Returns the message content, status (sent, delivered, read), and timestamps.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'The WhatsApp message ID (e.g. "wamid.HBgM...").'],
        ];
    }

    /**
     * Execute the tool — fetch the message from the API.
     *
     * @param  array{message_id?: string}  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WhatsApp integration is not configured.');
            }

            $messageId = $args['message_id'] ?? '';

            if (empty($messageId)) {
                return ToolResult::error('message_id is required.');
            }

            $result = $this->service->getMessage($messageId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
