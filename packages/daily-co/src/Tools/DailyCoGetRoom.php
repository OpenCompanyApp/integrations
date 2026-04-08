<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

use OpenCompany\Integrations\DailyCo\DailyCoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DailyCoGetRoom implements Tool
{
    public function __construct(
        private DailyCoService $service,
    ) {}

    public function name(): string
    {
        return 'daily_co_get_room';
    }

    public function description(): string
    {
        return 'Get details of a specific Daily.co room by name, including its URL, privacy setting, configuration properties, and participant limits.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The room name.'],
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

            $result = $this->service->getRoom($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
