<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohodesk_list_departments
 *
 * List all departments in the Zoho Desk organization.
 */
class ZohoDeskListDepartments implements Tool
{
    /**
     * @param  ZohoDeskService  $service  The Zoho Desk API service instance.
     */
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'zohodesk_list_departments';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all departments in the Zoho Desk organization. Useful for finding department IDs needed when creating or filtering tickets.';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — list departments from Zoho Desk.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            $result = $this->service->listDepartments();

            $departments = $result['data'] ?? $result['departments'] ?? $result;

            return ToolResult::success(is_array($departments) ? $departments : [$departments]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
