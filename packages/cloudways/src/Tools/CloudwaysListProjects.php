<?php

namespace OpenCompany\Integrations\Cloudways\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cloudways\CloudwaysService;

class CloudwaysListProjects implements Tool
{
    public function __construct(private CloudwaysService $service) {}

    public function name(): string
    {
        return 'cloudways_list_projects';
    }

    public function description(): string
    {
        return 'List all projects in the Cloudways account.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudways integration is not configured.');
            }

            $result = $this->service->listProjects();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
