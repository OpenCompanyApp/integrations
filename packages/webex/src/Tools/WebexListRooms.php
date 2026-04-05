<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\Integrations\Webex\WebexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebexListRooms implements Tool
{
    public function __construct(
        private WebexService $service,
    ) {}

    public function name(): string
    {
        return 'webex_list_rooms';
    }

    public function description(): string
    {
        return 'List Webex spaces (rooms) the authenticated user belongs to. Returns room IDs, titles, types, and last activity timestamps. Use for discovering available rooms before reading messages or posting.';
    }

    public function parameters(): array
    {
        return [
            'max' => ['type' => 'integer', 'description' => 'Maximum number of rooms to return (1–1000, default: 100).'],
            'before' => ['type' => 'string', 'description' => 'List rooms before this ISO 8601 timestamp (for pagination).'],
            'after' => ['type' => 'string', 'description' => 'List rooms after this ISO 8601 timestamp (for pagination).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Webex integration is not configured.');
            }

            $max = isset($args['max']) ? (int) $args['max'] : 100;
            $result = $this->service->listRooms(
                $max,
                $args['before'] ?? null,
                $args['after'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
