<?php

namespace OpenCompany\Integrations\Retell\Tools;

use OpenCompany\Integrations\Retell\RetellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: retell_get_current_user
 *
 * Retrieve the currently authenticated Retell AI user.
 *
 * @see https://docs.retellai.com/api-reference/me
 */
class RetellGetCurrentUser implements Tool
{
    /**
     * Create a new RetellGetCurrentUser tool instance.
     */
    public function __construct(
        private RetellService $service,
    ) {}

    /**
     * The tool identifier used for registration and routing.
     */
    public function name(): string
    {
        return 'retell_get_current_user';
    }

    /**
     * Human-readable description shown to AI agents and in tool listings.
     */
    public function description(): string
    {
        return 'Get information about the currently authenticated Retell AI user. Useful for verifying credentials and account details.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get-current-user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
