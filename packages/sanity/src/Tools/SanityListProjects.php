<?php

namespace OpenCompany\Integrations\Sanity\Tools;

use OpenCompany\Integrations\Sanity\SanityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SanityListProjects implements Tool
{
    public function __construct(
        private SanityService $service,
    ) {}

    public function name(): string
    {
        return 'sanity_list_projects';
    }

    public function description(): string
    {
        return 'List all Sanity projects accessible to the authenticated user. Requires a management API token.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sanity integration is not configured.');
            }

            $result = $this->service->listProjects();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
