<?php

namespace OpenCompany\Integrations\Autopilot\Tools;

use OpenCompany\Integrations\Autopilot\AutopilotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Autopilot list.
 */
class AutopilotGetList implements Tool
{
    public function __construct(
        private AutopilotService $service,
    ) {}

    public function name(): string
    {
        return 'autopilot_get_list';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Autopilot list, including contacts.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The list ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Autopilot integration is not configured.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('list_id is required.');
            }

            $result = $this->service->getList($args['list_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
