<?php

namespace OpenCompany\Integrations\Lark\Tools;

use OpenCompany\Integrations\Lark\LarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LarkListMessages implements Tool
{
    public function __construct(
        private LarkService $service,
    ) {}

    public function name(): string
    {
        return 'lark_list_messages';
    }

    public function description(): string
    {
        return 'List messages in a specific Lark chat. Returns message IDs, sender info, content, and timestamps.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'The chat ID to list messages from (e.g., "oc_a0553eda9014c201e6969b478895c230").'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of messages to return per page (max 50, default 20).'],
            'page_token' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to fetch the next page.'],
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

            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 20;
            $pageToken = $args['page_token'] ?? null;

            $result = $this->service->listMessages($args['chat_id'], $pageSize, $pageToken);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
