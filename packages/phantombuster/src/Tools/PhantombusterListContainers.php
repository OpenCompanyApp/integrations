<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\Integrations\Phantombuster\PhantombusterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PhantombusterListContainers implements Tool
{
    public function __construct(
        private PhantombusterService $service,
    ) {}

    public function name(): string
    {
        return 'phantombuster_list_containers';
    }

    public function description(): string
    {
        return 'List all Phantombuster containers (execution runs). Returns container IDs, associated agent IDs, status, and timestamps.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Phantombuster integration is not configured.');
            }

            $result = $this->service->listContainers();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
