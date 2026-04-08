<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\Integrations\Pushbullet\PushbulletService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PushbulletListPushes implements Tool
{
    public function __construct(
        private PushbulletService $service,
    ) {}

    public function name(): string
    {
        return 'pushbullet_list_pushes';
    }

    public function description(): string
    {
        return 'List recent pushes (notifications) from Pushbullet. Returns push items including notes, links, and files.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of pushes to return (default: 10, max: 500).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to get the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $cursor = $args['cursor'] ?? null;

            $result = $this->service->listPushes($limit, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
