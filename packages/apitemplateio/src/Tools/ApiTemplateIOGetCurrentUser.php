<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving the current authenticated user's account information.
 *
 * Sends a GET request to the /account endpoint to fetch the user's profile,
 * API usage, and subscription details.
 */
class ApiTemplateIOGetCurrentUser implements Tool
{
    /**
     * Create a new ApiTemplateIOGetCurrentUser tool instance.
     *
     * @param ApiTemplateIOService $service The API Template IO service instance.
     */
    public function __construct(
        private ApiTemplateIOService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The tool name.
     */
    public function name(): string
    {
        return 'apitemplateio_get_current_user';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the current authenticated user\'s account information from API Template IO, including usage and subscription details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, mixed> An empty array — this tool takes no parameters.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get current user account information.
     *
     * @param array<string, mixed> $args The tool arguments (unused).
     *
     * @return ToolResult The result containing the account details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('API Template IO integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
