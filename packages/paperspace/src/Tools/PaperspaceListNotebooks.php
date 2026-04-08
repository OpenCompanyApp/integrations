<?php

namespace OpenCompany\Integrations\Paperspace\Tools;

use OpenCompany\Integrations\Paperspace\PaperspaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaperspaceListNotebooks implements Tool
{
    public function __construct(
        private PaperspaceService $service,
    ) {}

    public function name(): string
    {
        return 'paperspace_list_notebooks';
    }

    public function description(): string
    {
        return 'List all Gradient notebooks in the Paperspace account. Returns notebook IDs, names, cluster, machine type, and state.';
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

            $result = $this->service->listNotebooks();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
