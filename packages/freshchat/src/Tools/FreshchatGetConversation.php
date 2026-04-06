<?php

namespace OpenCompany\Integrations\Freshchat\Tools;

use OpenCompany\Integrations\Freshchat\FreshchatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshchatGetConversation implements Tool
{
    public function __construct(
        private FreshchatService $service,
    ) {}

    public function name(): string
    {
        return 'freshchat_get_conversation';
    }

    public function description(): string
    {
        return 'Get full details of a specific Freshchat conversation by ID, including messages, participants, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The conversation ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshchat integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Conversation ID is required.');
            }

            $result = $this->service->getConversation($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
