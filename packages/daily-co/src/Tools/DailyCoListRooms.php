<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

use OpenCompany\Integrations\DailyCo\DailyCoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DailyCoListRooms implements Tool
{
    public function __construct(
        private DailyCoService $service,
    ) {}

    public function name(): string
    {
        return 'daily_co_list_rooms';
    }

    public function description(): string
    {
        return 'List video rooms from Daily.co. Returns a paginated list of rooms with their names, URLs, privacy settings, and creation dates.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of rooms to return (default: 20, max: 100).'],
            'ending_before' => ['type' => 'string', 'description' => 'Room ID used for cursor-based pagination. Returns rooms before this ID.'],
            'starting_after' => ['type' => 'string', 'description' => 'Room ID used for cursor-based pagination. Returns rooms after this ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Daily.co integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $endingBefore = $args['ending_before'] ?? null;
            $startingAfter = $args['starting_after'] ?? null;

            $result = $this->service->listRooms($limit, $endingBefore, $startingAfter);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
