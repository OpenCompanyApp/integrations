<?php

namespace OpenCompany\Integrations\Paperspace\Tools;

use OpenCompany\Integrations\Paperspace\PaperspaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaperspaceListProjects implements Tool
{
    public function __construct(
        private PaperspaceService $service,
    ) {}

    public function name(): string
    {
        return 'paperspace_list_projects';
    }

    public function description(): string
    {
        return 'List all Gradient projects in the Paperspace account. Returns project IDs, names, descriptions, and creation dates.';
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

            $result = $this->service->listProjects();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
