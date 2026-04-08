<?php

namespace OpenCompany\Integrations\Mindee\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mindee\MindeeService;

/**
 * Tool for retrieving the current authenticated Mindee user's information.
 *
 * Returns user account details from the Mindee API, useful for
 * verifying credentials and connection status.
 */
class MindeeGetCurrentUser implements Tool
{
    /**
     * Create a new MindeeGetCurrentUser tool instance.
     *
     * @param MindeeService $service The Mindee API service.
     */
    public function __construct(
        private MindeeService $service,
    ) {}

    /**
     * Get the tool's identifier name.
     */
    public function name(): string
    {
        return 'mindee_get_current_user';
    }

    /**
     * Get the tool's human-readable description.
     */
    public function description(): string
    {
        return 'Get the current authenticated Mindee user\'s account information — useful for verifying credentials and connection.';
    }

    /**
     * Get the tool's parameter schema.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * @param array<string, mixed> $args Tool arguments (none required).
     * @return ToolResult The user account data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mindee integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
