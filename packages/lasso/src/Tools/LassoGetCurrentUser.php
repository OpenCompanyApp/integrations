<?php

namespace OpenCompany\Integrations\Lasso\Tools;

use OpenCompany\Integrations\Lasso\LassoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Current User.
 *
 * Retrieves the profile of the currently authenticated Lasso CRM user,
 * including name, email, and organization details.
 */
class LassoGetCurrentUser implements Tool
{
    /**
     * @param  LassoService  $service  The Lasso API service instance.
     */
    public function __construct(
        private LassoService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'lasso_get_current_user';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated Lasso CRM user — name, email, organization, and other account details.';
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
     * Execute the get current user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Lasso CRM integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
