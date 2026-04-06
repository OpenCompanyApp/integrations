<?php

namespace OpenCompany\Integrations\Freshchat\Tools;

use OpenCompany\Integrations\Freshchat\FreshchatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshchatCreateConversation implements Tool
{
    public function __construct(
        private FreshchatService $service,
    ) {}

    public function name(): string
    {
        return 'freshchat_create_conversation';
    }

    public function description(): string
    {
        return 'Create a new Freshchat conversation. Specify the user ID, an initial message, and optionally a channel ID. The conversation will be started with the provided message.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the user to associate with the conversation.'],
            'initial_message' => ['type' => 'string', 'required' => true, 'description' => 'The first message to send in the conversation.'],
            'channel_id' => ['type' => 'string', 'description' => 'Optional channel ID to associate the conversation with a specific channel.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshchat integration is not configured.');
            }

            if (empty($args['user_id'])) {
                return ToolResult::error('User ID is required.');
            }

            if (empty($args['initial_message'])) {
                return ToolResult::error('Initial message is required.');
            }

            $result = $this->service->createConversation(
                $args['user_id'],
                $args['initial_message'],
                $args['channel_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
