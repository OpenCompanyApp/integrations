<?php

namespace OpenCompany\Integrations\Paperspace\Tools;

use OpenCompany\Integrations\Paperspace\PaperspaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaperspaceListMachines implements Tool
{
    public function __construct(
        private PaperspaceService $service,
    ) {}

    public function name(): string
    {
        return 'paperspace_list_machines';
    }

    public function description(): string
    {
        return 'List all GPU machines in the Paperspace account. Returns IDs, names, OS, machine type, state, and public IP address.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paperspace integration is not configured.');
            }

            $result = $this->service->listMachines();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
