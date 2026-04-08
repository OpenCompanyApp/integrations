<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\Integrations\Splunk\SplunkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplunkListSavedSearches implements Tool
{
    public function __construct(
        private SplunkService $service,
    ) {}

    public function name(): string
    {
        return 'splunk_list_saved_searches';
    }

    public function description(): string
    {
        return 'List all saved searches configured in Splunk. Returns search names, queries, schedules, and alert settings.';
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

            $result = $this->service->listSavedSearches();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
