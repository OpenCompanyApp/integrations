<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

use OpenCompany\Integrations\DailyCo\DailyCoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DailyCoListMeetings implements Tool
{
    public function __construct(
        private DailyCoService $service,
    ) {}

    public function name(): string
    {
        return 'daily_co_list_meetings';
    }

    public function description(): string
    {
        return 'List meetings from Daily.co with optional filters. Supports filtering by room, time range, and cursor-based pagination.';
    }

    public function parameters(): array
    {
        return [
            'room' => ['type' => 'string', 'description' => 'Filter meetings by room name.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of meetings to return (default: 20, max: 100).'],
            'starting_after' => ['type' => 'string', 'description' => 'Meeting ID used for cursor-based pagination. Returns meetings after this ID.'],
            'ending_before' => ['type' => 'string', 'description' => 'Meeting ID used for cursor-based pagination. Returns meetings before this ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Daily.co integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['room', 'limit', 'starting_after', 'ending_before'];

            foreach ($filterKeys as $key) {
                if (isset($args[$key])) {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listMeetings($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
