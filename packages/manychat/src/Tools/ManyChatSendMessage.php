<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

use OpenCompany\Integrations\ManyChat\ManyChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a message via ManyChat's Social messaging API.
 *
 * Supports sending messages through Instagram, Facebook Messenger,
 * WhatsApp, and SMS depending on the ManyChat account configuration.
 */
class ManyChatSendMessage implements Tool
{
    /**
     * @param  ManyChatService  $service  The Manychat API client.
     */
    public function __construct(
        private ManyChatService $service,
    ) {}

    public function name(): string
    {
        return 'manychat_send_message';
    }

    public function description(): string
    {
        return 'Send a message via ManyChat to a subscriber on Instagram, Messenger, WhatsApp, or SMS. Requires a subscriber ID and message content.';
    }

    public function parameters(): array
    {
        return [
            'subscriber_id' => ['type' => 'string', 'required' => true, 'description' => 'The ManyChat subscriber ID to send the message to.'],
            'message' => ['type' => 'object', 'required' => true, 'description' => 'The message payload to send. Can include text, buttons, cards, or other supported message types.'],
            'message_type' => ['type' => 'string', 'description' => 'The messaging channel: "instagram", "messenger", "whatsapp", or "sms". Defaults to the subscriber\'s primary channel.'],
        ];
    }

    /**
     * Send a compatibility message payload through sendContent.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ManyChat integration is not configured.');
            }

            if (empty($args['subscriber_id'])) {
                return ToolResult::error('subscriber_id is required.');
            }

            if (empty($args['message'])) {
                return ToolResult::error('message is required.');
            }

            $payload = [
                'subscriber_id' => $args['subscriber_id'],
                'message' => $args['message'],
            ];

            if (isset($args['message_type'])) {
                $payload['message_type'] = $args['message_type'];
            }

            $result = $this->service->sendMessage($payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
