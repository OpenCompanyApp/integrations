<?php

namespace OpenCompany\Integrations\Lark\Tools;

use OpenCompany\Integrations\Lark\LarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LarkGetChat implements Tool
{
    public function __construct(
        private LarkService $service,
    ) {}

    public function name(): string
    {
        return 'lark_get_chat';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Lark chat, including its name, description, owner, and member count.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'The chat ID to retrieve (e.g., "oc_a0553eda9014c201e6969b478895c230").'],
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

            $result = $this->service->getChat($args['chat_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
