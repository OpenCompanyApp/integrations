<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\Integrations\ChurnZero\ChurnZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Current User.
 *
 * Retrieves the profile of the currently authenticated ChurnZero user,
 * including name, email, role, and tenant information.
 *
 * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
 */
class ChurnZeroGetCurrentUser implements Tool
{
    /**
     * @param  ChurnZeroService  $service  The ChurnZero API service instance.
     */
    public function __construct(
        private ChurnZeroService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'churnzero_get_current_user';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated ChurnZero user — name, email, role, tenant, and other account details.';
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
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
