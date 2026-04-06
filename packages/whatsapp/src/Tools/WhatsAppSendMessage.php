<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a text message via the WhatsApp Cloud API.
 *
 * This tool sends a free-form text message to a single WhatsApp recipient.
 * For template-based messages (required for initiating conversations after 24h),
 * use {@see WhatsAppSendTemplate} instead.
 *
 * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#send-messages
 */
class WhatsAppSendMessage implements Tool
{
    /**
     * Create a new WhatsAppSendMessage tool instance.
     */
    public function __construct(
        private WhatsAppService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'whatsapp_send_message';
    }

    /**
     * Human-readable description shown to AI agents and users.
     */
    public function description(): string
    {
        return 'Send a text message to a WhatsApp recipient. Use this for replying within an existing 24-hour customer service window. For new conversations, use the send_template tool instead.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Recipient phone number in international format without + (e.g. "15551234567").'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Text content of the message (max 4096 characters).'],
            'preview_url' => ['type' => 'boolean', 'description' => 'Whether to render URLs as link previews in the message (default: false).'],
        ];
    }

    /**
     * Execute the tool — send the message via the WhatsApp Cloud API.
     *
     * @param  array{to?: string, body?: string, preview_url?: bool}  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WhatsApp integration is not configured.');
            }

            $to = $args['to'] ?? '';
            $body = $args['body'] ?? '';
            $previewUrl = $args['preview_url'] ?? false;

            if (empty($to)) {
                return ToolResult::error('Recipient "to" is required.');
            }

            if (empty($body)) {
                return ToolResult::error('Message "body" is required.');
            }

            $result = $this->service->sendMessage($to, $body, (bool) $previewUrl);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
