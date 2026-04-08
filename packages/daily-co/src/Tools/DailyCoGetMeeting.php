<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

use OpenCompany\Integrations\DailyCo\DailyCoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DailyCoGetMeeting implements Tool
{
    public function __construct(
        private DailyCoService $service,
    ) {}

    public function name(): string
    {
        return 'daily_co_get_meeting';
    }

    public function description(): string
    {
        return 'Get details of a specific Daily.co meeting by ID, including participant information, duration, and session data.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'The meeting UUID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Daily.co integration is not configured.');
            }

            if (empty($args['meeting_id'])) {
                return ToolResult::error('The meeting ID is required.');
            }

            $result = $this->service->getMeeting($args['meeting_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
