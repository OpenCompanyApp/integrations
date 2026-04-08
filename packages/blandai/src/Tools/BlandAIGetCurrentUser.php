<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\Integrations\BlandAI\BlandAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: BlandAI Get Current User
 *
 * Retrieves the authenticated user's account information from BlandAI.
 * Useful for verifying credentials and checking account details.
 */
class BlandAIGetCurrentUser implements Tool
{
    public function __construct(
        private BlandAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'blandai_get_current_user';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the authenticated BlandAI user\'s account information. Useful for verifying credentials and checking account details.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — fetch current user info.
     *
     * @param  array  $args  Tool arguments (unused for this tool).
     */
    public function execute(array $args = []): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
