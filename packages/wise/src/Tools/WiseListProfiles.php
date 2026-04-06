<?php

namespace OpenCompany\Integrations\Wise\Tools;

use OpenCompany\Integrations\Wise\WiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all Wise profiles for the authenticated user.
 *
 * Returns personal and business profiles associated with the Wise account.
 */
class WiseListProfiles implements Tool
{
    /**
     * Create a new WiseListProfiles instance.
     *
     * @param WiseService $service The Wise API service client.
     */
    public function __construct(
        private WiseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'wise_list_profiles';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List all Wise profiles (personal and business) for the authenticated user.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — list all profiles.
     *
     * @param array $args Tool arguments (none required).
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wise integration is not configured.');
            }

            $profiles = $this->service->listProfiles();

            return ToolResult::success($profiles);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
