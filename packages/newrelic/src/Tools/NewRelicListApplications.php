<?php

namespace OpenCompany\Integrations\NewRelic\Tools;

use OpenCompany\Integrations\NewRelic\NewRelicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NewRelicListApplications implements Tool
{
    public function __construct(
        private NewRelicService $service,
    ) {}

    public function name(): string
    {
        return 'newrelic_list_applications';
    }

    public function description(): string
    {
        return 'List APM applications in the configured New Relic account. Returns application names, GUIDs, IDs, language, reporting status, and health status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('New Relic integration is not configured.');
            }

            $result = $this->service->listApplications();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
