<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

use OpenCompany\Integrations\Anthropic\AnthropicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Backward-compatible alias for organization information.
 *
 * Anthropic does not expose /users/me. This calls /organizations/me
 * through the Admin API and requires an Admin API key.
 *
 * @see https://docs.anthropic.com/en/api/admin-api/organization/get-me
 */
class AnthropicGetCurrentUser implements Tool
{
    /**
     * @param  AnthropicService  $service  The Anthropic service instance.
     */
    public function __construct(
        private AnthropicService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'anthropic_get_current_user';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Backward-compatible alias for Anthropic organization information. Requires an Admin API key.';
    }

    /**
     * Parameter schema - no parameters required.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the organization lookup alias.
     *
     * @param  array  $args  No parameters required.
     * @return ToolResult The user profile or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isAdminConfigured()) {
                return ToolResult::error('Anthropic Admin API key is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
