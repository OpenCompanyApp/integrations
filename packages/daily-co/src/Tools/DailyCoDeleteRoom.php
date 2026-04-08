<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

use OpenCompany\Integrations\DailyCo\DailyCoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DailyCoDeleteRoom implements Tool
{
    public function __construct(
        private DailyCoService $service,
    ) {}

    public function name(): string
    {
        return 'daily_co_delete_room';
    }

    public function description(): string
    {
        return 'Delete a Daily.co video room by name. This permanently removes the room and it cannot be rejoined.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The room name to delete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Daily.co integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The room name is required.');
            }

            $result = $this->service->deleteRoom($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
