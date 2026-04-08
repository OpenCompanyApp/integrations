<?php

namespace OpenCompany\Integrations\Transifex\Tools;

use OpenCompany\Integrations\Transifex\TransifexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Transifex projects the authenticated user has access to.
 */
class TransifexListProjects implements Tool
{
    public function __construct(
        private TransifexService $service,
    ) {}

    public function name(): string
    {
        return 'transifex_list_projects';
    }

    public function description(): string
    {
        return 'List all Transifex projects. Returns project slugs, names, descriptions, and language statistics.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Transifex integration is not configured.');
            }

            $result = $this->service->listProjects();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
