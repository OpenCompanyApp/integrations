<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\Integrations\Splunk\SplunkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplunkListIndexes implements Tool
{
    public function __construct(
        private SplunkService $service,
    ) {}

    public function name(): string
    {
        return 'splunk_list_indexes';
    }

    public function description(): string
    {
        return 'List all Splunk indexes available to the authenticated user. Returns index names, sizes, event counts, and retention settings.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splunk integration is not configured.');
            }

            $result = $this->service->listIndexes();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
