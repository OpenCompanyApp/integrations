<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebflowListSites implements Tool
{
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_list_sites';
    }

    public function description(): string
    {
        return 'List all Webflow sites the authenticated user has access to. Returns site IDs, names, and domains needed for further CMS operations.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            $result = $this->service->listSites();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
