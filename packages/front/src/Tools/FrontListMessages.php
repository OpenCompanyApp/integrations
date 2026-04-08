<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FrontListMessages implements Tool
{
    public function __construct(
        private FrontService $service,
    ) {}

    public function name(): string
    {
        return 'front_list_messages';
    }

    public function description(): string
    {
        return 'List all messages in a Front conversation. Returns paginated message details including sender, body, and timestamps.';
    }

    public function parameters(): array
    {
        return [
            'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'The conversation ID (e.g., "cnv_123abc").'],
            'limit' => ['type' => 'integer', 'description' => 'Number of messages per page (max 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            $result = $this->service->listMessages(
                id: $args['conversation_id'],
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                page: isset($args['page']) ? (int) $args['page'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
