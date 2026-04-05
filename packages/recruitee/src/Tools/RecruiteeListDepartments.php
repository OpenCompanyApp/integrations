<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

use OpenCompany\Integrations\Recruitee\RecruiteeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RecruiteeListDepartments implements Tool
{
    /**
     * Create a new RecruiteeListDepartments tool instance.
     */
    public function __construct(
        private RecruiteeService $service,
    ) {}

    /**
     * Get the tool name (slug).
     */
    public function name(): string
    {
        return 'recruitee_list_departments';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all departments in Recruitee. Returns department names and IDs that can be used to filter offers.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recruitee integration is not configured.');
            }

            $result = $this->service->listDepartments();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
