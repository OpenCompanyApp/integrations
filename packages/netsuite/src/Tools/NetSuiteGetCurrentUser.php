<?php

namespace OpenCompany\Integrations\NetSuite\Tools;

use OpenCompany\Integrations\NetSuite\NetSuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NetSuiteGetCurrentUser implements Tool
{
    /**
     * Create a new NetSuiteGetCurrentUser tool instance.
     */
    public function __construct(
        private NetSuiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'netsuite_get_current_user';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated NetSuite user. Returns user details like name, email, role, and subsidiary.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('NetSuite integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
