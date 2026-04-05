<?php

namespace OpenCompany\Integrations\Onfleet\Tools;

use OpenCompany\Integrations\Onfleet\OnfleetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific Onfleet task.
 *
 * Retrieves full task details including destination address, recipient info,
 * assigned worker, completion status, and tracking information.
 */
class OnfleetGetTask implements Tool
{
    public function __construct(
        private OnfleetService $service,
    ) {}

    public function name(): string
    {
        return 'onfleet_get_task';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific delivery task by its ID. Returns destination, recipient, worker assignment, completion details, and tracking info.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'The Onfleet task ID (24-character hex string).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Onfleet integration is not configured.');
            }

            if (empty($args['task_id'])) {
                return ToolResult::error('Task ID is required.');
            }

            $result = $this->service->getTask($args['task_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
