<?php

namespace OpenCompany\Integrations\Modal\Tools;

use OpenCompany\Integrations\Modal\ModalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all schedules for a Modal app.
 */
class ModalListSchedules implements Tool
{
    public function __construct(
        private ModalService $service,
    ) {}

    public function name(): string
    {
        return 'modal_list_schedules';
    }

    public function description(): string
    {
        return 'List all scheduled functions for a Modal app. Returns schedule IDs, cron expressions, and function details.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'The ID of the Modal app to list schedules for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Modal integration is not configured.');
            }

            $appId = $args['app_id'] ?? '';
            if (empty($appId)) {
                return ToolResult::error('The app_id parameter is required.');
            }

            $result = $this->service->listSchedules($appId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
