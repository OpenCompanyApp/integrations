<?php

namespace OpenCompany\Integrations\Opsgenie\Tools;

use OpenCompany\Integrations\Opsgenie\OpsgenieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated Opsgenie user.
 *
 * Useful for verifying that credentials are valid and identifying the connected account.
 */
class OpsgenieGetCurrentUser implements Tool
{
    /**
     * Create a new OpsgenieGetCurrentUser tool instance.
     *
     * @param  OpsgenieService  $service  The Opsgenie API service
     */
    public function __construct(
        private OpsgenieService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'opsgenie_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Opsgenie user. Useful for verifying credentials and identifying the connected account.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the current user info.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Opsgenie integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
