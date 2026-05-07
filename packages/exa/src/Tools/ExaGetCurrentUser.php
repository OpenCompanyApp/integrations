<?php

namespace OpenCompany\Integrations\Exa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Exa\ExaService;

/**
 * Get the currently authenticated Exa user's profile and usage information.
 *
 * Useful for verifying credentials and checking API usage limits.
 */
class ExaGetCurrentUser implements Tool
{
    /**
     * @param  ExaService  $service  The Exa API client.
     */
    public function __construct(
        private ExaService $service,
    ) {}

    public function name(): string
    {
        return 'exa_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Exa user\'s profile information, including email and API usage details. Useful for verifying credentials.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get-current-user request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Exa integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
