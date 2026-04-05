<?php

namespace OpenCompany\Integrations\Aircall\Tools;

use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving the currently authenticated user from the Aircall API.
 *
 * Returns the user details for the account associated with the configured
 * access token, including name, email, and availability status.
 *
 * @see https://developer.aircall.io/api-references/#retrieve-the-current-user
 */
class AircallGetCurrentUser implements Tool
{
    /**
     * Create a new AircallGetCurrentUser tool instance.
     *
     * @param  AircallService  $service  The Aircall API service instance.
     */
    public function __construct(
        private AircallService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'aircall_get_current_user';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Retrieve the currently authenticated Aircall user. Returns user details including name, email, and availability status.';
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
     * @param  array  $args  No parameters required.
     * @return ToolResult The result containing the current user details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Aircall integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
