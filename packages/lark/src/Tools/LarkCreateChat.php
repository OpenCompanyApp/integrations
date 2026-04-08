<?php

namespace OpenCompany\Integrations\Lark\Tools;

use OpenCompany\Integrations\Lark\LarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LarkCreateChat implements Tool
{
    public function __construct(
        private LarkService $service,
    ) {}

    public function name(): string
    {
        return 'lark_create_chat';
    }

    public function description(): string
    {
        return 'Create a new group chat in Lark. Specify a chat ID and name for the new chat.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'A unique identifier for the new chat (e.g., "oc_my_new_chat").'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The display name for the new group chat.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lark integration is not configured.');
            }

            if (empty($args['chat_id'])) {
                return ToolResult::error('chat_id is required.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('name is required.');
            }

            $result = $this->service->createChat($args['chat_id'], $args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
