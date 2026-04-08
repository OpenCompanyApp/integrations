<?php

namespace OpenCompany\Integrations\Paperspace\Tools;

use OpenCompany\Integrations\Paperspace\PaperspaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaperspaceListDatasets implements Tool
{
    public function __construct(
        private PaperspaceService $service,
    ) {}

    public function name(): string
    {
        return 'paperspace_list_datasets';
    }

    public function description(): string
    {
        return 'List all datasets in the Paperspace account. Returns dataset IDs, names, storage usage, and creation dates.';
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

            $result = $this->service->listDatasets();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
