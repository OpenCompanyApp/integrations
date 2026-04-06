<?php

namespace OpenCompany\Integrations\Kimai\Tools;

use OpenCompany\Integrations\Kimai\KimaiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KimaiGetTimesheet implements Tool
{
    public function __construct(
        private KimaiService $service,
    ) {}

    public function name(): string
    {
        return 'kimai_get_timesheet';
    }

    public function description(): string
    {
        return 'Get details of a specific timesheet entry from Kimai. Returns the full timesheet record including begin/end timestamps, duration, description, project, activity, and user information.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The timesheet entry ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kimai integration is not configured.');
            }

            $result = $this->service->getTimesheet((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
